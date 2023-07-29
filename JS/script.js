$(document).ready(function(){
  $("#userdetail").click(function(){
	$.ajax({ 
	    type: 'GET', 
	    url: 'http://127.0.0.1:8081/api/logisticuser/listall', 
	    dataType: 'jsonp',
	    success: function (data) { 
	    	console.log(data);
	        $.each(data, function(index, element) {
	            $('body').append($('<div>', {
	                text: element.name
	            }));
	        });
	    }
	});
	if ($("#branchlist")[0]){
		console.log("Branch List");
	}else{
		console.log("Something Else List");
	}

	$(".viewbranch").click(function(){
		console.log("View Branch");
		window.location.href = "html/ViewAddBranch.html";
	});


	$(".addbranch").click(function(){
		window.location.href = "html/ViewAddBranch.html";
	});

	$(".viewuser").click(function(){
		window.location.href = "html/ViewAddUser.html";
	});

	$(".adduser").click(function(){
		window.location.href = "html/ViewAddUser.html";
	});

	$(".createshipment").click(function(){
		window.location.href = "html/AddDelivery.html";
	});

	$(".genqr").click(function(){
		window.location.href = "html/GenerateQR.html";
	});
	
});

  $(".addshipment").click(function(){
  	var fromFirst=$('.fromfirstName').val();
  	var fromLast=$('.fromfirstName').val();
  	var fromAddress=$('.fromfirstName').val();
  	var fromPin=$('.fromfirstName').val();
  	var fromCity=$('.fromfirstName').val();
  	var fromLandmark=$('.fromfirstName').val();
  	var fromContact=$('.fromfirstName').val();

  	var toFirst=$('.tofirstName').val();
  	var toLast=$('.tofirstName').val();
  	var toAddress=$('.tofirstName').val();
  	var toPin=$('.tofirstName').val();
  	var toCity=$('.tofirstName').val();
  	var toLandmark=$('.tofirstName').val();
  	var toContact=$('.tofirstName').val();
  	var logisticUser="";
  	$.ajax({ 
	    type: 'GET', 
	    url: 'http://127.0.0.1:8081/api/logisticuser/listall', 
	    dataType: 'jsonp',
	    success: function (data) { 
	    	console.log(JSON.stringify(data[0]));

	    	logisticUser=data[0];
	        
	    }
	});
	var weight=$('.weight').val();
	var weightType=$('.tofirstName').val();
	var quantity=$('.quantity').val();
	var shipFrom={"firstName": fromFirst,
					"lastName": fromLast,
        			"address": fromAddress,
			        "pincode": fromPin,
			        "city": fromCity,
			        "landmark": fromLandmark,
			        "contactNumber": fromContact};
	var shipTo={"firstName": toFirst,
					"lastName": toLast,
        			"address": toAddress,
			        "pincode": toPin,
			        "city": toCity,
			        "landmark": toLandmark,
			        "contactNumber": toContact};
	var packageDetails={"weight":weight,
						"weightType":weightType,
						"quantity":quantity
						};
	var payload={
		"pkgAddressFrom":shipFrom,
		"pkgAddressTo":shipTo,
		"logisticUserInfo":logisticUser,
		"packageDetails":packageDetails

	};
	console.log(payload);

  	$.ajax({
	    type: 'POST',
	    url: 'http://127.0.0.1:8081/api/delivery/add',
	    data: payload, // or JSON.stringify ({name: 'jonas'}),
	    success: function(data) { alert('data: ' + data); },
	    contentType: "application/json",
	    dataType: 'jsonp'
	});

  	console.log(fromFirst);
  });
});




