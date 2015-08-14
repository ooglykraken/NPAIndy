<?php

get_header(); ?>
	
	<!-- site-content -->
	<div class="site-content clearfix">
		
		<!-- main-column -->
		<div class="main-column">
			<?php if (have_posts()) :
				while (have_posts()) : the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>

				<!-- Google Map Mode of Travel -->
				<div id="panel">
				<b>Mode of Travel: </b>
				<select id="mode" onchange="calcRoute();">
				  <option value="DRIVING">Driving</option>
				  <option value="WALKING">Walking</option>
				  <option value="BICYCLING">Bicycling</option>
				  <option value="TRANSIT">Transit</option>
				</select>
				</div>
				<!-- /Google Map Mode of Travel -->
				
				<br />
				
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
				
				<!-- Google Map Start Point -->
				<form action="http://maps.google.com/maps" target="_blank" method="get">
					<b>Enter your starting address:</b>
					<input type="text" name="saddr" />
					<input type="hidden" name="daddr" value="10293 North Meridian Street - Suite 210 Indianapolis, Indiana 46290" />
					<input type="submit" value="Get Directions" />
				</form>
				<!-- /Google Map Start Point -->
				
				<br />
				<br />
				
				<!-- Google Mape -->
				
				<script type="text/javascript">
					var directionsDisplay;
					var directionsService = new google.maps.DirectionsService();
					var map;
					var destination;
					
					function initialize() {
						directionsDisplay = new google.maps.DirectionsRenderer();
						
						var mapCanvas = document.getElementById('map-canvas');
						destination =  new google.maps.LatLng(39.9356, -86.156);
						
						var mapOptions = {
						  center: destination,
						  zoom: 17,
						  mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						
						var marker = new google.maps.Marker({
							position: destination,
							map: map,
							title: 'NPA Indy'
						});
						
						map = new google.maps.Map(mapCanvas, mapOptions)
						
						directionsDisplay.setMap(map);
						directionsDisplay.setPanel(document.getElementById("directionsPanel"));
						marker.setMap(map);
					}
					
					function calcRoute() {
						var selectedMode = document.getElementById("mode").value
						
						var start = document.getElementById("saddr").value;
						
						var request = {
							origin: start,
							end: destination,
							travelMode: google.maps.TravelMode[selectedMode]
						};
						
						directionsService.route(request, function(response, status) {
							if (status == google.maps.DirectionsStatus.OK) {
								directionsDisplay.setDirections(response);
							}
						});
					}	
					
					google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				
				<div id="map-canvas"></div>
				<!-- /Google Map -->
				
				<?php endwhile;

				else :
					echo '<p>No content found</p>';

				endif;
				?>
		</div><!-- /main-column -->

		<?php get_sidebar(); ?>
		
	</div><!-- /site-content -->
	
	<?php get_footer();

?>