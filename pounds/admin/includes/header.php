<?php
session_start();
require_once 'class.user.php';

  $auth_user = new USER();
  $logged = $auth_user -> is_loggedin();

if (!$logged){
  echo "The session is ".$_SESSION['user_session'] 
  ?>
<script>
  alert("I had to kick your ass back to compton!!!");
  //window.location.replace("index.php");
</script>

  <?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pounds Apparel Admin</title>

  <!-- Custom fonts for this template-->
  <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon" /> 
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../images/logo.png"></img>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="payment.php">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Items</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="banner.php">
          <i class="fas fa-fw fa-audio-description"></i>
          <span>Banners</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-globe"></i>
          <span>Users</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="cbooking.php">
          <i class="fas fa-fw fa-edit"></i>
          <span>Orders</span></a>
      </li>
        
        <li class="nav-item">
        <a class="nav-link" href="chatapp.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Support</span></a>
      </li>
      <?php

if ($_SESSION["user_role"] =="admin")
{

?>
      <li class="nav-item">
        <a class="nav-link" href="centres.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Messages</span></a>
      </li>

<?php

}


?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link" href="logout.php?logout=true">
          <i class="fas fa-fw fa-share-square"></i>
          <span>Logout</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->