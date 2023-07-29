
<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="../JS/script.js"></script>
		<link rel="stylesheet" href="../CSS/stylesheet.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
	<body>
		<?php
	 $path=dirname(__FILE__).'/'.'../menu.php';
   include($path);

  
    $s_sql = mysqli_query($link,"select address,city,pincode,landmark from addnewbranchestb where id = '$branch_session' ");
   
   $rw = mysqli_fetch_array($s_sql,MYSQLI_ASSOC);
   
   $branch_address = $rw['address'];
   $branch_city = $rw['city'];
   $branch_pincode = $rw['pincode'];
   $branch_landmark = $rw['landmark'];
    if (isset($_POST['adddelivery']))
      {
        $fromfirstName=$_POST['ffn'];
        $fromlastName=$_POST['fln'];
        $fromAddress=$_POST['fad'];
        $fromCity=$_POST['fc'];
        $fromPincode=$_POST['fpc'];
        $fromLandmark=$_POST['flm'];
        $fromContact=$_POST['fct'];

        $tofirstName=$_POST['sfn'];
        $tolastName=$_POST['sln'];
        $toAddress=$_POST['sad'];
        $toCity=$_POST['sc'];
        $toPincode=$_POST['spc'];
        $toLandmark=$_POST['slm'];
        $toContact=$_POST['sct'];

       
        $pkgWeight=$_POST['wt'];
		$pkgUnit=$_POST['ut'];
		$pkgQuantity=$_POST['qt'];

        $shippingFromQuery="INSERT INTO shippingfrom(firstname,lastname,address,city,pincode,landmark,contact) VALUES ('$fromfirstName','$fromlastName','$fromAddress','$fromCity','$fromPincode','$fromLandmark','$fromContact')";
        mysqli_query($link,$shippingFromQuery);
        $shipFromId = mysqli_insert_id($link);

        $shippingToQuery="INSERT INTO shippingto(firstname,lastname,address,city,pincode,landmark,contact) VALUES ('$tofirstName','$tolastName','$toAddress','$toCity','$toPincode','$toLandmark','$toContact')";
        mysqli_query($link,$shippingToQuery);
        $shipToId = mysqli_insert_id($link);
        


		$packageQuery="INSERT INTO packagedetails(weight,unit,quantity) VALUES ('$pkgWeight','$pkgUnit','$pkgQuantity')";
		mysqli_query($link,$packageQuery);
		$packageId = mysqli_insert_id($link);

		$shippingQuery="INSERT INTO shippingdetails(fromid,toid,packageid,branchid) VALUES ('$shipFromId','$shipToId','$packageId','$branch_session')";
		mysqli_query($link,$shippingQuery);
		$shippingId = mysqli_insert_id($link);

		$deliveryQuery="INSERT INTO deliverystatus(shippingid,branchid) VALUES ('$shippingId','$branch_session')";
		mysqli_query($link,$deliveryQuery);
		$deliveryId = mysqli_insert_id($link);


 		header("location: AddDelivery.php");
      }
 ?>

		<div class="container" >
			<h5>Shippment Details</h5>
			<form method="POST" >
			<div class="card">

				<table class="table">
    
		  <div class="row">
		    <div class="col">
		    	<div class="card">
 				 <div class="card-body">
		      <h5 class="card-title">Shipping From</h5>
		      	<div class="row">
			      	<div class="col">
			      		<div class="input-group mb-3">
						  <span class="input-group-text">Person</span>
						  <input type="text" class="form-control" placeholder="First Name" name="ffn" autofocus required>
						  <input type="text" class="form-control" placeholder="Last Name" name="fln" required>
						</div>
					</div>
			    </div>
			<div class="row">
				<div class="col">
					<div class="mb-3">
					  <label for="fromAddress" class="form-label">Address</label>
					  <input class="form-control form-control-lg fromAddress" type="text" placeholder="Address"  name="fad" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="mb-3">
					  <label for="frompinCode" class="form-label">Pincode</label>
					  <input class="form-control form-control-lg frompinCode" type="text" value="<?php echo $branch_pincode ?>"  name="fpc" placeholder="Pincode"  required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="fromCity" class="form-label">City</label>
					  <input class="form-control form-control-lg fromCity" type="text" value="<?php echo $branch_city ?>"  name="fc" placeholder="City" required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="fromLandmark" class="form-label">Landmark</label>
					  <input class="form-control form-control-lg fromLandmark" type="text" value="<?php echo $branch_landmark ?>" name="flm" placeholder="Landmark" required>
					</div>
				</div>
			</div>
				<div class="mb-3">
				  <label for="fromContact" class="form-label">Contact</label>
				  <input class="form-control form-control-lg fromContact" type="text"  name="fct" placeholder="Contact" required>
				</div>				
				</div></div>
			</div>
			<!-- SHIPPING TO -->
 <div class="col">
 	<div class="card">
  		<div class="card-body">
		      <h5 class="card-title">Shipping To</h5>
		      	<div class="row">
			      	<div class="col">
			      		<div class="input-group mb-3">
						  <span class="input-group-text">Person</span>
						  <input type="text" class="form-control" placeholder="First Name" name="sfn" required>
						  <input type="text" class="form-control" placeholder="Last Name" name="sln" required>
						</div>
					</div>
			    </div>
				<div class="row">
					<div class="col">
						<div class="mb-3">
						  <label for="fromAddress" class="form-label">Address</label>
						  <input class="form-control form-control-lg fromAddress" type="text" placeholder="Address"  name="sad" required>
						</div>
					</div>
				</div>
			<div class="row">
				<div class="col">
					<div class="mb-3">
					  <label for="frompinCode" class="form-label">Pincode</label>
					  <input class="form-control form-control-lg frompinCode" type="text"  name="spc" placeholder="Pincode"  required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="fromCity" class="form-label">City</label>
					  <input class="form-control form-control-lg fromCity" type="text"  name="sc" placeholder="City" required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="fromLandmark" class="form-label">Landmark</label>
					  <input class="form-control form-control-lg fromLandmark" type="text"  name="slm" placeholder="Landmark" required>
					</div>
				</div>
			</div>
				<div class="mb-3">
				  <label for="fromContact" class="form-label">Contact</label>
				  <input class="form-control form-control-lg fromContact" type="text"  name="sct" placeholder="Contact" required>
				</div>				
				
			</div>

			</div>
		</div></div>
			<div class="row">
				

			</div>
		    
		  <div class="col">
		  	<div class="card">
 		  <div class="card-body">
		  	<div class="row">
		  		<br/>
		  		<h5 class="card-title">Package Details</h5>
		  	</div>
		    <div class="row">
		    	<div class="col">
			    	<div class="mb-3">
					  <label for="weight" class="form-label" name="wt" >Weight</label>
					  <input class="form-control form-control-lg weight" type="text" name="wt" placeholder="Weight" required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="weightType" class="form-label" name="ut" >Unit</label>
					  <input class="form-control form-control-lg weightType" type="text"  name="ut" placeholder="Unit" required>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
					  <label for="toContact" class="form-label" name="qt" >Quantity</label>
					  <input class="form-control form-control-lg quantity" type="text" name="qt" placeholder="Quantity" required>
					</div>
			    </div>
				
			</div>
			
			<!--<button type="button" class="btn btn-primary addshipment">-->
			</div></div>
		</div>
		<input type="submit" name="adddelivery" class="btn btn-primary addshipment" >

	</form>
	</div>
	

	<!--  -->
	</body>
</html>
