<?php
include "includes/header.php"; 
include "includes/inner-header.php";
include "config/config";

$item_id = $_GET["itemid"];
$res = $auth_user->delItems($item_id);
  if($res){
  	?>
<script>
	alert("Item Deleted");
	window.location.replace("payment.php");
</script>
<?php
  }


?>