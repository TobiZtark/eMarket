<?php 
include "includes/header.php"; 
include "includes/inner-header.php";
include "config/config";

if(isset($_POST["register"])){
echo "";
$user_id = $_POST["user_id"]; 
$cpassword = $_POST["cpassword"];
$password = md5($cpassword);

$res = $auth_user->changeUser($user_id, $password);


  if($res){
  	?>
<script>
	alert("Password Updated");
	window.location.replace("user.php");
</script>
<?php
  }

}

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Change User Password</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
<form action="#" method="post">
<div class="form-group">
<input type="hidden" class="form-control" value="<?php echo $_GET['userid']; ?>" placeholder="User ID" name="user_id" >
</div>
<div class="form-group">
<input type="number" class="form-control" value="" placeholder="New Password (at least 6 digits)" name="cpassword" >
</div>
<button type="submit" name="register" value="register">Update</button>
</form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<?php
     include "includes/footer.php"; 

?>