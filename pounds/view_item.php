<?php
include "include/header2.php";
?>
<div class="container">
	<?php
if (isset($_GET["item_id"])){

$item_id= $_GET["item_id"];

$auth_user-> descItem($item_id);

}
else{
?>
<script>
  alert("Unauthorized Access! Please return to Home");
  window.location.replace("index.php");
</script>
<?php

}
?>

		
</div>
		<?php
		include "include/footer.php";


		?>

		<script src="../code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="../code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="js/jquery.fullPage.min.js" type="text/javascript"></script>
		<script src="js/masonry.pkdg.min.js" type="text/javascript"></script>
		<script src="js/lightcase.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/functions.js" type="text/javascript"></script>
	</body>

</html>