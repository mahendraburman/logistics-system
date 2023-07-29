
<!DOCTYPE html>
<html lang="en"> 
 <head>
  <title>Add/View Branch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script>
  $(document).ready(function(){
    $("#addbranchmodal").modal('show');
  });
</script> -->

</head> 
<body>
<?php
   $path=dirname(__FILE__).'/'.'../menu.php';
   include($path);

  ?> 
  <div class="container-fluid">
    <div class="row">
       <div class="col-md-12">
          <div class="mt-5 mb-3 clearfix">
          <h3 class="pull-left">Branch Information</h3>
        
          <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addbranchmodal">
            Add Branch
          </button>
        </div>
      </div>
    </div>
     <table class="table">
    <thead>
    <?php

      //$con=mysqli_connect('localhost:3307','root','','logisticdb');
      $sql = "SELECT id, address, city, contact,pincode,landmark FROM addnewbranchestb";
      $result = $link->query($sql);

      if ($result->num_rows > 0) {
        echo "<tr><th>Action</th><th>#</th><th>Address</th><th>City</th><th>Contact</th><th>Pincode</th><th>Landmark</th></tr></thead>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<tbody><tr><td> <div class="btn-group">';
          echo '<form action="" method="POST" id="'.$row["id"].'">';
          echo '<input type="hidden" name="id" value="'.$row["id"].'"/>';
   echo  '<button type="submit" class="btn btn-danger"><span class="bi bi-trash-fill"></span></button>
    </form>';
    echo "</div></td>
          <td>".$row["id"]."</td>
          <td>".$row["address"]."</td>
          <td>".$row["city"]."</td>
          <td>".$row["contact"]."</td>
          <td>".$row["pincode"]."</td>
          <td>".$row["landmark"]."</td>
          </tr></tbody>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
      
        // Prepare a delete statement
        $sql = "DELETE FROM addnewbranchestb WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location: AddBranch.php");
              //  exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        //mysqli_close($link);
        }/* else{
            // Check existence of id parameter
            if(empty(trim($_GET["id"]))){
                // URL doesn't contain id parameter. Redirect to error page
               header("location: mainapp/AddBranch.php");
              //  exit();
            }
        }*/

      if (isset($_POST['sb']))
      {
        $address=$_POST['ad'];
        $contact=$_POST['ct'];
        $city=$_POST['c'];
        $pincode=$_POST['pc'];
        $landmark=$_POST['lm'];
        $query="INSERT INTO addnewbranchestb(address,contact,city,pincode,landmark) VALUES ('$address','$contact','$city','$pincode','$landmark')";
        $run=mysqli_query($link,$query);
         header("location: AddBranch.php");
      }
      ?>
    </div>
<!-- <div class="container mt-3">
  <h3>Add Branches</h3>
  
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbranchmodal">
    Open modal
  </button>
</div> 
 -->
<!-- The Modal -->
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
         
          <input type="submit" name="sb" class="btn btn-primary"/>
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </form>
      </div>

      <!-- Modal footer -->
     <!--  <div class="modal-footer">
       
      </div> -->

    </div>
  </div>
</div>


 </body>
</html> 
