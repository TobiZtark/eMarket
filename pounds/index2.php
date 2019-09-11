<?php 
include "include/header2.php";

?>

<div class="container">
		<!-- End Menu Lightbox -->
        <section >
				<ul class="unstyled">	<!-- SLIDE  -->
						<li data-transition="fade" data-masterspeed="1200" data-thumb="images/slide_3.jpg" data-saveperformance="on" data-title="COLOR IT">
								<!-- MAIN IMAGE -->
                                <a href="index.php#info-block"><img src="images/slide_3.jpg" alt="Slide 1" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"></a>
								<!-- LAYERS -->
			
								<!-- LAYER NR. 1 -->
							<div class="tp-caption desc editContent"
								data-x="0"
								data-y="center" 
								data-hoffset="0" 
			     				data-voffset="-10"
								data-frames='[{"delay":800,"speed":1200,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[30%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":700,"frame":"999","to":"y:[-100%];","ease":"Power3.easeInOut"}]'
								style="z-index: 6;"><!-----<span class="subtitle">Like Kings...</span>--->
							</div>
			
								<!-- LAYER NR. 2 -->
							<a href="index.php#info-block" class="tp-caption desc editContent"
								data-x="0"
								data-y="center" 
								data-hoffset="0" 
			     				data-voffset="30"
								data-frames='[{"delay":800,"speed":1200,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[30%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":700,"frame":"999","to":"y:[-100%];","ease":"Power3.easeInOut"}]'
								style="z-index: 5;"><!-----<h2>Wear Your Magic!</h2>--->
							</a>
						</li>
					</ul>
			</section>
		<div class="fullpage">
			<!-- End Menu Lightbox -->
			
			<!-- Start Info-block Section -->
			<section id="info-block" class="section extra-pad">
				<div class="container">
					<div class="row">
						<div class="span5">
							<div class="info-block pad-top-liq" style="margin-top: -40%;">
								<div class="title-block">
									<h2 data-scrolled-into-view>Our Awesome Categories</h2>
								</div>
								<div data-scrolled-into-view>
									<form method="get" action="category.php">
								<input type="text" class="" style="" name="category" placeholder="Enter Keywords..."><button class="button spec-hover" value="submit" style="margin-bottom: 10%;"><span>Search</span></button> 
								</form></div>
								<div class="text" data-scrolled-into-view>
									<li><a href="category.php?category=attires" style="color: black;">Men Attires</a></li>
									<li><a href="category.php?category=fabrics" style="color: black;">Fabrics</a></li>
									<li><a href="category.php?category=shoes" style="color: black;">Shoes</a></li>
									<li><a href="category.php?category=watches" style="color: black;">Wristwatches</a></li>
									<li><a href="category.php?category=accessories" style="color: black;">Accessories</a></li>
								</div>
							</div>
					</div>
						<div class="span7">
							<figure class="ipad-mockup">
							</figure>
						</div>
					</div>
				</div>
			</section>
			<!-- End Info-block Section -->
			<?php
		include "include/features.php";
		include "include/new.php";
		include "include/top.php";
		include "include/fivek.php";
		include "include/contact.php";


		?>

		</div><!-- end div .fullpage -->
	</div>
		<?php
		include "include/footer.php";


		?>

		<script src="../code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="../code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript">
		var map;
			function initMap() {
			  var styles = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
			  map = new google.maps.Map(document.getElementById('map'), {
			    center: {lat: -34.397, lng: 150.644},
			    zoom: 15,
			    navigationControl:!1,
			    mapTypeControl:!1,
			    scaleControl:!1,
			    streetViewControl:!1,
			  });
			  map.setOptions({styles: styles});
				var address = 'West Village, NY, USA';
				var geocoder = new google.maps.Geocoder();
				var image = 'images/map-marker.png';
				geocoder.geocode({
				  'address': address
				}, 
				function(results, status) {
				  if(status == google.maps.GeocoderStatus.OK) {
				     new google.maps.Marker({
				        position: results[0].geometry.location,
				        map: map,
				        icon: image
				     });
				     map.setCenter(results[0].geometry.location);
				  }
				});
				
			}
    	</script>
		<script async defer src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d440.2801698952604!2d7.465258513041309!3d9.082418022108635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0aef32acc231%3A0xbeefd72576abafa!2sOlive+plaza!5e0!3m2!1sen!2sng!4v1564033563407!5m2!1sen!2sng"></script>
		<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    	<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script> 
		<script src="js/jquery.fullPage.min.js" type="text/javascript"></script>
		<script src="js/masonry.pkdg.min.js" type="text/javascript"></script>
		<script src="js/lightcase.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/functions-home.js" type="text/javascript"></script>
	</body>
</html>