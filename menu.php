<?php
 $sessionpath=dirname(__FILE__).'/'.'/LoginForm/session.php';
   include($sessionpath);
   $mainpath = "http://".$_SERVER['SERVER_NAME']."/myproject";
   //$mainpath .= "/myproject";
  // echo $mainpath
  # $path = realpath(dirname(__FILE__)) . "/";
 //  echo $mainpath."/index.php";
   //

echo
'<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="'.$mainpath.'/index.php">Logistics System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
      	
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Branch</a>
          <ul class="dropdown-menu">
		    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addbranchmodal">Add Branch</a></li>
		    <li><a  href="'.$mainpath.'/mainapp/AddBranch.php" class="dropdown-item" href="#">View Branches</a></li>
		  </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">User</a>
          <ul class="dropdown-menu">
		    <li><a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#addUserhmodal" >Add User</a></li>
		    <li><a href="'.$mainpath.'/mainapp/ViewAddUser.php" class="dropdown-item" href="#">View User</a></li>
		  </ul>
        </li>
        <li class="nav-item">
          <a href="'.$mainpath.'/mainapp/AddDelivery.php" class="nav-link" >Shipping</a>
        </li>
      </ul>
      <form class="d-flex">
        <button type="button" class="btn btn-outline-dark text-light">Welcome '.$login_session.'['.$branch_city_session.']</button>
        <a href = "'.$mainpath.'/LoginForm/logout.php" class="btn btn-danger" >Sign Out</a>
      </form>
    </div>
  </div>
</nav>'
?>