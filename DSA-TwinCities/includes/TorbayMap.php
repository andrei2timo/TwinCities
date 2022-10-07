<?php

$title = 'PlacesOfInterest-Torbay';
$currentPage = 'poitorbay';
include_once __DIR__ . "/config.php";
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
    <script>
      // Initialize and add the map
	  function PlacesOfInterest(latitude, longitude, icon, title, description,map)
	  {
			const GeoLocation = { lat: latitude , lng: longitude };
			const marker1 = new google.maps.Marker({
			position: GeoLocation,
			});
			marker1.setMap(map);
	  }
      function initMap() {
        // The location of GeoLocation
        const GeoLocation = { lat: 50.462061769162496, lng: -3.525112061217559 };
        // The map, centered at GeoLocation
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: GeoLocation,
        });
        // The marker, positioned at GeoLocation
        const marker = new google.maps.Marker({
          position: GeoLocation,
          map: map,
        });
		var placesData = [];
		placeData.push({ 'latitude': 50.482466 , 'longitude': -3.520361 , 'interest_icon': 'sight.png', 'name':'Babbacombe model village', 'short_description':'Ariel shot of the village showing the gardens and landscape.'});
        placesOfInterest(placesData[0]['latitude'], placesData[0]['longitude'], placesData[0]['interest_icon'],placesData[0]['name'], placesData[0]['short_description'],map);
      }
    </script>
  </head>
  
  <body>
    <h3>Places of interest in Torbay</h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_5RhpGqk3MLa6_dniOSwj2QFuawSSTdY&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>