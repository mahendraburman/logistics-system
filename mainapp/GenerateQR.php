<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="../JS/script.js"></script>
		<link rel="stylesheet" href="../CSS/stylesheet.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
<script>
	$(document).ready(function(){
		$(".generateQR").click(function(){
			console.log("Hello");
			var qrdata=$('.qrdata').val();
		  	
		  	
		  	$.ajax({
			    type: 'GET',
			    url: 'http://127.0.0.1:8081/api/qr/generate/jdfhjd',
			    //data: JSON.stringify(addBranch), // or JSON.stringify ({name: 'jonas'}),
			    success: function(data) { 
			    	//var objectURL = URL.createObjectURL(data);
			    	const b64Response = data => {
  const reader = new FileReader();
  reader.readAsDataURL(data);
  return new Promise(resolve => {
    reader.onloadend = () => {
      resolve(reader.result);
    };
  });
};
			    	//var b64Response = btoa(data);

// create an image

			    	$('.qresponse').html('<img src="' + b64Response + '" />'); 
			    }
			    
			});
		});
		
		});

</script>
	</head>
	<body>
		<body>
		<h4>QR Data</h4>
		

<div class="card" style="width: 24rem;">
		  <div class="card-body">
		    <h5 class="card-title">Generate QR Code</h5>
		    <p class="card-text">Generate QR Code for package shipment </p>
		    <div class="mb-3">
					  <label for="qrdata" class="form-label">QR Data</label>
					  <input class="form-control form-control-lg qrdata" type="text" name="qrdata" placeholder="QR Data"/>
					</div>
		  </div>
		</div>
		<button type="button" class="btn btn-primary generateQR">Generate QR</button>
		<div class=" qresponse">
		</div>
	</body>
	</html>