<?php
session_start();
include "class.user.php";

$auth_user = new USER();
 $logged = $auth_user -> is_loggedin();

/*if (!$logged){
  echo "The session is ".$_SESSION['user_session'] 
  ?>
<script>
  alert("I had to kick you out of the Pounds Shop!!!");
  //window.location.replace("index.php");
</script>

  <?php
}*/

if (isset($_POST["login"])){
$email= $_POST["email"];
$pass = $_POST["password"];

$loggedin = $auth_user -> doLogin($email,$pass);
if ($loggedin){
  ?>
<script>
  alert("Welcome to Pounds Apparel!!!");
  window.location.replace("index.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("User details are wrong! Please try again!!");
  window.location.replace("index.php");
</script>

  <?php
}

}

if(isset($_GET["item_id"]) && isset($_GET["name"])){
	if($_SESSION['user_session'] != ""){
	$item_id = $_GET["item_id"];
	$user_id = $_SESSION['user_session'];
	$name = $_GET["name"];
	$price = $_GET["price"];
	$quantity = "1";

$plot = $auth_user -> cartItem($user_id,$item_id, $quantity, $name, $price);
if ($plot){
  ?>
<script>
  alert("Item was successfully added to cart");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Oops! Something went wrong! Please try again!!");
</script>

  <?php
}
}
else{
	?>
<script>
  alert("Please Log in or Register to add item to Cart!");
</script>

  <?php
}
}

if (isset($_POST["message_center"])){
$email= $_POST["email"];
$message = $_POST["message"];
$name = $_POST["name"];

$messagein = $auth_user -> doMessage($email, $message, $name);
if ($messagein){
  ?>
<script>
  alert("Message has been sent!!!");
  window.location.replace("index.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Message Failure! Please try again!!");
  window.location.replace("index.php");
</script>

  <?php
}

}

if (isset($_POST["register"])){
$email= $_POST["email"];
$password = $_POST["password"];
$pass = md5($password);
$name = $_POST["name"];
$gender = $_POST["gender"];

$register = $auth_user -> register($name, $email, $pass, $gender);
if ($register){
  ?>
<script>
  alert("Congratulations! Registration Successful");
  window.location.replace("index.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Registration Unsuccessful! Please try again!!");
  window.location.replace("index.php");
</script>

  <?php
}

}


if (isset($_GET["delete"])){
$id= $_GET["cart_id"];

$delete = $auth_user -> deleteItem($id);
if ($delete){
  ?>
<script>
  alert("Delete Successful");
  window.location.replace("cart.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Delete Unsuccessful! Please try again!!");
  window.location.replace("cart.php");
</script>

  <?php
}

}


if (isset($_GET["orderdelete"])){
$id= $_GET["order_id"];

$delete = $auth_user -> deleteorder($id);
if ($delete){
  ?>
<script>
  alert("Delete Successful");
  window.location.replace("my_orders.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Delete Unsuccessful! Please try again!!");
  window.location.replace("my_orders.php");
</script>

  <?php
}

}

if (isset($_POST["updateProfile"])){
$email= $_POST["email"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$state = $_POST["state"];
$user_id = $_SESSION["user_session"];
$update = $auth_user -> updateProfile($user_id, $name, $email, $phone, $address, $state);
if ($update){
  ?>
<script>
  alert("Congratulations! Update Successful");
  window.location.replace("logout.php?logout=logout");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Update Unsuccessful! Please try again!!");
  window.location.replace("edit_profile.php");
</script>

  <?php
}

}

if (isset($_GET["order"]) && isset($_GET["total"])){
$total = $_GET["total"];
$order_id = substr(md5(uniqid(rand(1,6))), 0, 8);
$phone = $_SESSION['user_phone'];
$email = $_SESSION['user_email'];
$user_id = $_SESSION['user_session'];
$order = $auth_user -> orderItems($order_id, $user_id, $email, $phone, $total);
if ($order){
  ?>
<script>
  alert("Congratulations! Order has been successfully placed");
  window.location.replace("cart.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Order was unsuccessful! Please try again!!");
  window.location.replace("cart.php");
</script>

  <?php
}

}


if (isset($_POST["cartUpdate"])){
$id= $_POST["id"];
$quantity = $_POST["quantity"];

$update = $auth_user -> updateCart($id, $quantity);
if ($update){
  ?>
<script>
  alert("Congratulations! Update Successful");
  window.location.replace("cart.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Update Unsuccessful! Please try again!!");
  window.location.replace("cart.php");
</script>

  <?php
}

}


if (isset($_POST["update"])){
$email= $_POST["email"];
$password = $_POST["password"];
$pass = md5($password);
$name = $_POST["name"];

$update = $auth_user -> updatePass($name, $email, $pass);
if ($update){
  ?>
<script>
  alert("Congratulations! Password Update Successful");
  window.location.replace("index.php");
</script>

  <?php
} else 
{
	?>
<script>
  alert("Update Unsuccessful! Please try again!!");
  window.location.replace("index.php");
</script>

  <?php
}

}


?>
<!DOCTYPE html>
<html lang="en-US">
<head>
		<meta charset="utf-8">
		<title>Pounds Apparel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,400,700|Playfair+Display:400,400i" rel="stylesheet">
		<link href="css/jquery.fullPage.css" type="text/css" rel="stylesheet">
		<link href="css/lightcase.css" rel="stylesheet">
		<link href="css/ionicons/css/ionicons.min.css" type="text/css" rel="stylesheet">
		<link href="css/pe-icon-7-stroke/css/pe-icon-7-stroke.min.css" type="text/css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/basic.css" rel="stylesheet">
		<link href="css/owl.carousel.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="rs-plugin/css/layers.css" media="screen"> 
        <link rel="stylesheet" type="text/css" href="rs-plugin/css/navigation.css" media="screen">
        <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen">
		<link href="css/grid.css" rel="stylesheet">
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link href="css/responsive.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Begin Header -->
		<header id="header" style="">
			<div class="container">
				<div class="span12">
					<div class="logo span11"><a href="index.php" style="margin-left:-8%;"><img src="images/logo.png" class="light" alt="logo"><img src="images/logo-dark.png" class="dark" alt="logo"><h1 style="margin-top:;"></h1></a></div>
					<div class="span1" style="position: fixed; background: #f0ad4e; padding: 15px; ">
					<a href="#" style="" class="menu-button-open"><span class="line1"></span><span class="line2"></span><span class="line3"></span></a></div>
				</div>

			</div>
		</header>
		
		<div class="menu-lightbox">
			<header id="lightbox-header">
				<div class="container">

						<div class="logo span10"><a href="index.php" style="margin-left:-8%;"><img src="images/logo.png" alt="logo"><h1 style="margin-top:;"></h1></a></div>
						<div class="span2">
						<a href="#" class="menu-button-close" style=""><span class="line1"></span><span class="line2"></span></a></div>

				</div>
			</header>
			<div class="dtable">
				<div class="dtcell">
					<div class="span4">
					<img src="images/info-ipad.png">
					</div>
					<div class="span4">
					<!-- Start Menu -->
					<ul id="menu" class="menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="index.php#info-block">Categories</a></li>
						<li><a href="index.php#fs">Featured Shop</a></li>
						<li><a href="index.php#na">New Arrivals</a></li>
						<li><a href="index.php#ts">Top Shop</a></li>
						<li><a href="index.php#u5s">Under 5k Shop</a></li>
						<li><a href="index.php#contacts">Contact</a></li>

					</ul>
				</div>
				<div class="span4">
					<div class="container">
					<?php
					if(!$logged){
					?>
					<form method="post" action="#">
					<input type="email" class="" style="" name="email" placeholder="Enter Email...">
					<input type="password" class="" style="" name="password" placeholder="Enter Password...">
					<button class="button spec-hover" name="login" value="submit" style="margin-bottom: 10%;"><span>Log In</span></button> &nbsp; or &nbsp;
					<button type="button" class="button spec-hover" data-toggle="modal" data-target="#myModal"><span>Sign Up</span></button> <br>
					<button type="button" style="padding: 2px 18px" class="btn btn-warning" data-toggle="modal" data-target="#myModal2">Forgotten your Password? Click Here!</button>
					</form>
					<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f0ad4e; padding: 15px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pounds Apparel Sign Up</h4>
      </div>
      <div class="modal-body" style="background-color: black;">
        <form method="post" action="#">
        			<input type="text" name="name" placeholder="Enter Name...">
					<input type="email" name="email" placeholder="Enter Email...">
					<input type="password" name="password" placeholder="Enter Password...">
					<select style="margin-bottom:8%;" name="gender">
						<option style="color:black;" value="">Please select a gender</option>
  						<option style="color:black;" value="f">Female</option>
  						<option style="color:black;" value="m">Male</option>
					</select>
					<button class="button spec-hover" name="register" value="submit" style="margin-bottom: 10%;"><span>Sign Up</span></button>
					</form>
      </div>
    </div>
  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog" style="">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f0ad4e; padding: 15px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reset Password</h4>
      </div>
      <div class="modal-body" style="background-color: black;">
        <form method="post" action="#">
        			<input type="text" name="name" placeholder="Enter Name...">
					<input type="email" name="email" placeholder="Enter Email...">
					<input type="password" name="password" placeholder="Enter New Password...">
					<button class="button spec-hover" name="update" value="submit" style="margin-bottom: 10%;"><span>Reset Password</span></button>
					</form>
      </div>
    </div>
  </div>
</div>
					<?php
				   } else {
				   	?>
				   	<h2 style="color:white;"> Hi, <?php echo $_SESSION['user_name']; ?></h2>
				   	<b><a href="user_profile.php">My Profile</a>&nbsp; | &nbsp; <a href="cart.php">View Cart</a> &nbsp; | &nbsp;<a href="my_orders.php">My Orders</a> &nbsp; | &nbsp;<a href="logout.php?logout=logout">Logout</a></b>
				   	<?php
				   }

					?>

				<form method="get" action="category.php">
							<input type="text" class="" style="margin-top:8%;" name="category" placeholder="Enter Keywords..."><button class="button spec-hover" value="submit" style="margin-bottom: 10%;"><span>Search</span></button> 
						</form>
					</div>
				</div>
				</div>
			</div>
		</div>
			<footer id="lightbox-footer">
				<div class="container">
					<div class="span12">
						<div class="copyright">&copy; 2019 Pounds Apparel</div>
						<ul class="socials">
							<li class="facebook"><a href="#"><i class="fa fa-facebook"></i><div>Facebook</div></a></li>
							<li class="twitter"><a href="#"><i class="fa fa-twitter"></i><div>Twitter</div></a></li>
							<li class="instagram"><a href="#"><i class="fa fa-instagram"></i><div>Instagram</div></a></li>
							<li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i><div>LinkedIn</div></a></li>
							
						</ul>
					</div>
				</div>
			</footer>
		</div>
