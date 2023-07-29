
<!DOCTYPE html>
<html lang="en"> 
 <head>
  <title>ViewAdd user</title>
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
          <h3 class="pull-left">User Information</h3>
        
          <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addUserhmodal">
            Add User
          </button>
        </div>
      </div>
    </div>
     <table class="table">
    <thead>
    <?php

     // $con=mysqli_connect('localhost:3307','root','','logisticdb');
      $sql = "SELECT u.id, u.username, u.password, u.role,b.city,b.pincode,b.address FROM userinfo u,addnewbranchestb b where u.branchid=b.id";
      $result = $link->query($sql);

      if ($result->num_rows > 0) {
        echo "<tr><th>Action</th><th>#</th><th>User Name</th><th>Password</th><th>Role</th><th>Branch Address</th></tr></thead>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<tbody><tr><td> <div class="btn-group">';
          if($login_session!=$row["username"]){
          	 echo '<form action="" method="POST" id="'.$row["id"].'">';
          echo '<input type="hidden" name="id" value="'.$row["id"].'"/>';
   echo  '<button type="submit" class="btn btn-danger"><span class="bi bi-trash-fill"></span></button>
    </form>';
          }else{
          	 echo '<form action="" method="POST" id="'.$row["id"].'">';
          echo '<input type="hidden" name="id" value="'.$row["id"].'"/>';
   echo  '<button type="submit" class="btn btn-danger" disabled><span class="bi bi-trash-fill"></span></button>
    </form>';
          }
         
    echo "</div></td>
          <td>".$row["id"]."</td>
          <td>".$row["username"]."</td>
          <td>".$row["password"]."</td>
          <td>".$row["role"]."</td>
          <td>".$row["address"].", ".$row["city"].", ".$row["pincode"]."</td>
          </tr></tbody>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
      
        // Prepare a delete statement
        $sql = "DELETE FROM userinfo WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location: ViewAddUser.php");
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
        $username=$_POST['un'];
        $password=$_POST['pwd'];
        $role=$_POST['role'];
        $branchid=$_POST['branch'];
        $query="INSERT INTO userinfo(username,password,role,branchid) VALUES ('$username','$password','$role','$branchid')";
        $run=mysqli_query($link,$query);
         header("location: ViewAddUser.php");
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
