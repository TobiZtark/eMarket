<?php
include "include/header2.php";
?>
<div class="container">
<?php
if(isset($_GET["category"])){

$category = $_GET["category"];

$auth_user -> viewItem($category);
}

if(isset($_GET["items"])){

$auth_user -> viewAllItem();
}

if (!isset($_GET["items"]) && !isset($_GET["category"])){
?>
<script>
  alert("Unauthorized Access! Please return to Home");
  window.location.replace("index.php");
</script>
<?php

}
?>

					
					<div class="portfolio-item portfolio-more-items">
						<a href="category.php?items=all" class="load-more active"><span>MORE</span></a><!-- portfolio load-more button -->
					</div>
				</div> <!-- end portfolio container -->
			</section>
		</div>
			<!-- End Portfolio Section -->
			<?php
		include "include/footer.php";


		?>
		<script src="../code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="../code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfbDATAIBSQEUY0YzOEjzcB8A1W2FNKSQ&amp;libraries=places,geometry&amp;callback=initMap&amp;v=3.26"></script>
		<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    	<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script> 
		<script src="js/jquery.fullPage.min.js" type="text/javascript"></script>
		<script src="js/masonry.pkdg.min.js" type="text/javascript"></script>
		<script src="js/lightcase.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/functions-home.js" type="text/javascript"></script>
	</body>
</html>