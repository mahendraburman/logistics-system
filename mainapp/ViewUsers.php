<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="../JS/script.js"></script>
		<link rel="stylesheet" href="../CSS/stylesheet.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>

		
		<?php  include('config.php'); 
			if (isset($_GET['del'])) {
				$id = $_GET['del'];
				$pin = $_GET['pin'];
				mysqli_query($link, "DELETE FROM addnewbranchestb WHERE id=$id or id IS NULL or pincode=$pin");
			}
		?>
		<?php $results=mysqli_query($link, "SELECT * FROM addnewbranchestb"); ?>
		<table class="table  table-dark table-striped">
		  <thead>
		    <tr>
		      <th scope="col">Action</th>
		      <th scope="col">ID</th>
		      <th scope="col">Address</th>
		      <th scope="col">Contact</th>
		      <th scope="col">City</th>
		      <th scope="col">Pincode</th>
		      <th scope="col">Landmark</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php while ($row=mysqli_fetch_array($results)) { ?>
		        <tr>
		        	<td><a href="ViewUsers.php?id=<?php echo $row['id']; ?>&pin=<?php echo $row['pincode']; ?>" class="del_btn">Delete</a></td>
		        	<td><?php echo $row['id']; ?></td>
		            <td><?php echo $row['address']; ?></td>
		            <td><?php echo $row['contact']; ?></td>
		            <td><?php echo $row['city']; ?></td>
		            <td><?php echo $row['pincode']; ?></td>
		            <td><?php echo $row['landmark']; ?></td>
		        </tr>
		    <?php } ?>
		  </tbody>
		</table>

	</body>
	</html>