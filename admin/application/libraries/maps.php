<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maps
{
	public function googleMap($id, $lat, $lng, $title='',$zoom=14){
		echo "
			<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false'></script>
			<script>
				var map;
				function initialize() {
					var myLatlng = new google.maps.LatLng(".$lat.",".$lng.");
					var mapOptions = {
						zoom: ".$zoom.",
						center: myLatlng
					};
					map = new google.maps.Map(document.getElementById('".$id."'),mapOptions);
					var marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: '".$title."'
					});
				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
		";
	}
} 


