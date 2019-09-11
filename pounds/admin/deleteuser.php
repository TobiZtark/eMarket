<?php
include "includes/header.php"; 
include "includes/inner-header.php";
include "config/config";

$user_id = $_GET["userid"];
$res = $auth_user->delUsers($user_id);
  if($res){
  	?>
<script>
	alert("Account Deleted");
	window.location.replace("user.php");
</script>
<?php
  }


?>