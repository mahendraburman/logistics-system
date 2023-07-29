<?php
?>
<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- <script src="JS/script.js"></script> -->
		<!-- <link rel="stylesheet" href="CSS/stylesheet.css"> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	</head>
	<body>

<?php
	 $path=dirname(__FILE__).'/'.'menu.php';
   include($path);

   	$deliveryStatusSQL = "SELECT s.shippingid,s.status,DATE_FORMAT( s.shippingdate , '%d/%m/%Y' ) as shippingdate,DATE_FORMAT( DATE_ADD(s.shippingdate , INTERVAL 7 DAY) , '%d/%m/%Y' ) as arrivaldate,p.weight,p.unit,p.quantity,t.firstname as tfirstname,t.lastname as tlastname,t.address as taddress,t.city as tcity,t.pincode as tpincode,t.landmark as tlandmark,t.contact as tcontact,f.firstname,f.lastname,f.address,f.city,f.pincode,f.landmark,f.contact, b.address as baddress, b.city as bcity, b.contact as bcontact,b.pincode as bpincode,b.landmark as blandmark FROM shippingdetails s,packagedetails p,shippingto t,shippingfrom f,addnewbranchestb b where status!='Delivered' and p.packageid=s.packageid and s.fromid=f.fromid and s.toid=t.toid and s.branchid=b.id";
      $deliveryStatusResult = $link->query($deliveryStatusSQL);
?>
<br></br>
<div class="container">
<div id="accordion">
<?php
 if ($deliveryStatusResult->num_rows > 0) {
      	 while($row = $deliveryStatusResult->fetch_assoc()) {
          $toCity=strtolower($row["tcity"]);
          $fromCity=strtolower($row["city"]);
          $shippingstatus=$row["status"];
          $toPincode=$row["tpincode"];
          $actionButton='Track';
          $enableButton='enabled';
           if($fromCity==strtolower($branch_city_session)){
          	$enableButton='disabled';
          }
          if($toCity==strtolower($branch_city_session) || $toPincode==$branch_pincode_session){
          	$actionButton='Arrived';
          }
          if($shippingstatus=='Arrived' && ($toCity==strtolower($branch_city_session) || $toPincode==$branch_pincode_session)){
          	$actionButton='Delivered';
          }

		  echo '<div class="card">';
		    echo '<div class="card-header">';
		    echo  '<div class="row"><div class="col-sm-5">From- '.$row["city"].' [Dispatched Date- '.$row["shippingdate"].']'.'</div><div class="col-sm-5">To- '.$row["tcity"]. ' [Arrival Date- '.$row["arrivaldate"].']';
		    echo  '</div><div class="col-sm-1"><a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapse'.$row["shippingid"].'">
		       View
		      </a>';
		       echo '</div><div class="col-sm-1"><form action="" method="POST" id="'.$row["shippingid"].'">';
          echo '<input type="hidden" name="'.$actionButton.'" value="'.$row["shippingid"].'"/>';
		    echo  '<button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal" '.$enableButton.'>'.$actionButton.'</button> </form>
		    </div></div></div>';
		   
		   echo '<div id="collapse'.$row["shippingid"].'" class="collapse" data-bs-parent="#accordion">
		      <div class="card-body">';
		       echo '<div class="row">
					<div class="col">
					<div class="progress" style="height:20px">';
		     	$shipid= $row["shippingid"];
		      	$statusSQL = "SELECT   b.address as baddress, b.city as bcity, b.contact as bcontact,b.pincode as bpincode,b.landmark as blandmark FROM deliverystatus s, addnewbranchestb b where b.id=s.branchid and shippingid='$shipid' order by s.deliveryid" ;
      			$statusResult = $link->query($statusSQL);

	     		 if ($statusResult->num_rows > 0) {
	     		 	$pPercent=100/($statusResult->num_rows+1);
	     		 	$count=0;
	     		 	while($statusRow = $statusResult->fetch_assoc()) {
	     		 		$buttonType='bg-success';
	     		 		$count=rand(1,5);
	     		 		if($count==1){
	     		 			$buttonType='bg-success';
	     		 		}else if($count==2){
	     		 			$buttonType='bg-primary';
	     		 		}else if($count==3){
	     		 			$buttonType='bg-danger';
	     		 		}else if($count==4){
	     		 			$buttonType='bg-warning';
	     		 		}else if($count==5){
	     		 			$buttonType='bg-secondary';
	     		 		}
	     		 		echo '<div class="progress-bar '.$buttonType.'" style="width:'.$pPercent.'%">
							    '.$statusRow["bcity"].' | '.$statusRow["bpincode"].'
							  </div>';
					 
	     		 	}
	     		 }
		      	/*$branchSQL = "SELECT  b.address as baddress, b.city as bcity, b.contact as bcontact,b.pincode as bpincode,b.landmark as blandmark FROM addnewbranchestb b where b.id=";
      			$branchResult = $link->query($branchSQL);
				*/
     

		       
					echo '</div>
				</div>
				</div><br/>';
					echo    '<div class="row">
			      		<div class="col">
					        <div class="card">
							  <div class="card-body">

							<h5 class="card-title">From- '.$row["city"].' [Dispatched Date- '.$row["shippingdate"].']</h5>
							    <p class="card-text">'.$row["firstname"].' '.$row["lastname"].'
							    <br/>Address- '.$row["address"].', '.$row["landmark"].'
								<br/>PinCode-'.$row["pincode"].'
								<br/>Contact- '.$row["contact"].'</p>
							  </div>
							</div>
						</div>
						<div class="col">
							<div class="card">
							  <div class="card-body">
							   <h5 class="card-title">To- '.$row["tcity"].' [Exp. Arrival Date- '.$row["arrivaldate"].']</h5>
							    <p class="card-text">'.$row["tfirstname"].' '.$row["tlastname"].'
							    <br/>Address- '.$row["taddress"].', '.$row["tlandmark"].'
								<br/>PinCode-'.$row["tpincode"].'
								<br/>Contact- '.$row["tcontact"].'</p>

							  </div>
							</div>
						</div>
					</div>
					<br/>
					<div class="col">
								<div class="card">
								  <div class="card-body">
								    <h4 class="card-title">Package Details</h4>
								    <p class="card-text"> Weight-'.$row["weight"].' Unit-'.$row["unit"].' Quantity-'.$row["quantity"].'</p>
								</div>
							</div>
						</div>
					</br>
		      </div>
		    </div>
		  </div>';
  	}
  	}
?>

</br></br>
	<!-- Modal code starts-->
	<div class="modal fade" id="addbranchmodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Branches</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST">
          <div class="mb-3 mt-3">
            <label for="ad" class="form-label">Address</label>
            <input type="text" class="form-control" id="ad" placeholder="Enter address" name="ad">
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" class="form-control" id="city" placeholder="Enter city" name="c">
          </div>
         
           <div class="mb-3">
            <label for="pin" class="form-label">Pincode</label>
            <input type="text" class="form-control" id="pin" placeholder="Enter PinCode" name="pc">
          </div>
           <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" placeholder="Enter Contact" name="ct">
          </div>
            <div class="mb-3">
            <label for="landmark" class="form-label">Landmark</label>
            <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="lm">
          </div>
         
          <input type="submit" name="branchdata" class="btn btn-primary"/>
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </form>
      </div>

      <!-- Modal footer -->
     <!--  <div class="modal-footer">
       
      </div> -->

    </div>
  </div>
</div>

<!-- user modal -->
<div class="modal fade" id="addUserhmodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST">
          <div class="mb-3 mt-3">
            <label for="username" class="form-label">User Name:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="un">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="pwd">
          </div>
         
           <div class="mb-3">
            <label for="cpwd" class="form-label">Confirm Password</label>
            <input type="text" class="form-control" id="cpwd" placeholder="Re-Enter password" name="cpwd">
          </div>
           <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" aria-label="Role selection">
              <option value="user" selected>User</option>
			  <option value="admin">Admin</option>
			 
			
			</select> 
          </div>
		<div class="mb-3">
            <label for="role" class="form-label">Select Branch</label>
            <select class="form-select" name="branch" aria-label="Role selection">
            	<?php

			     
			      $sql = "SELECT id, address, city, pincode FROM addnewbranchestb";
			      $result = $link->query($sql);

			      if ($result->num_rows > 0) {
			        echo "<tr><th>Action</th><th>#</th><th>User Name</th><th>Password</th><th>Role</th</tr></thead>";
			        // output data of each row
			        while($row = $result->fetch_assoc()) {
			        	echo '<option value="'.$row["id"].'">'.$row["address"].' | '.$row["city"].' | '.$row["pincode"].'</option>';
			        }
			    }
			     ?>
			
			</select> 
          </div>
          <input type="submit" name="adduserdata" class="btn btn-primary"/>
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </form>
      </div>

      <!-- Modal footer -->
     <!--  <div class="modal-footer">
       
      </div> -->

    </div>
  </div>
</div>
<?php
 if (isset($_POST['Track']))
      {
        $shippingid=$_POST['Track'];
        echo("<script>console.log('PHP: " . $shippingid . "');</script>");
       	$deliveryQuery="INSERT INTO deliverystatus(shippingid,branchid) VALUES ('$shippingid','$branch_session')";
		mysqli_query($link,$deliveryQuery);
		$deliveryId = mysqli_insert_id($link);
		$query="update shippingdetails set status='Dispatched' where shippingid='$shippingid'";
        $run=mysqli_query($link,$query);
        header("location: index.php");
        //header("Refresh:0");
      }
      if (isset($_POST['Arrived']))
      {
        $shippingid=$_POST['Arrived'];
        echo("<script>console.log('PHP: " . $shippingid . "');</script>");
       	$deliveryQuery="INSERT INTO deliverystatus(shippingid,branchid) VALUES ('$shippingid','$branch_session')";
		mysqli_query($link,$deliveryQuery);
		$deliveryId = mysqli_insert_id($link);
		$query="update shippingdetails set status='Arrived' where shippingid='$shippingid'";
        $run=mysqli_query($link,$query);
         header("location: index.php");
      }
      if (isset($_POST['Delivered']))
      {
        $shippingid=$_POST['Delivered'];
       	$deliveryQuery="INSERT INTO deliverystatus(shippingid,branchid) VALUES ('$shippingid','$branch_session')";
		mysqli_query($link,$deliveryQuery);
		$deliveryId = mysqli_insert_id($link);
		$query="update shippingdetails set status='Delivered' where shippingid='$shippingid'";
        $run=mysqli_query($link,$query);

         header("location: index.php");
      }
    if (isset($_POST['branchdata']))
      {
        $address=$_POST['ad'];
        $contact=$_POST['ct'];
        $city=$_POST['c'];
        $pincode=$_POST['pc'];
        $landmark=$_POST['lm'];
        $query="INSERT INTO addnewbranchestb(address,contact,city,pincode,landmark) VALUES ('$address','$contact','$city','$pincode','$landmark')";
        $run=mysqli_query($link,$query);
         header("location: index.php");
      }
       if (isset($_POST['adduserdata']))
      {
        $username=$_POST['un'];
        $password=$_POST['pwd'];
        $role=$_POST['role'];
         $branchid=$_POST['branch'];
        $query="INSERT INTO userinfo(username,password,role,branchid) VALUES ('$username','$password','$role','$branchid')";
        $run=mysqli_query($link,$query);
         header("location: index.php");
      }
?>
	</body>
</html>