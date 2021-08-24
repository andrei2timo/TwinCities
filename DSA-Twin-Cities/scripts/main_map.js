/**
 * Created by Jacob on 04/03/2018.
 */

//NOT THE BEST DESIGN - REQUIRES VARIABLES BEFORE CALLING THIS SCRIPT

var lng3 = (lng2 + lng1) / 2;
var lat3 = (lat2 + lat1) / 2;

function calculateDistance(lat1,lng1,lat2,lng2) {
    //Used some basic maths to calculate this
    var R = 6371; // Radius of the earth in km
    var dLat = degToRad(lat2-lat1);
    var dLng = degToRad(lng2-lng1);
    var a =
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(degToRad(lat1)) * Math.cos(degToRad(lat2)) *
        Math.sin(dLng/2) * Math.sin(dLng/2)
    ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    return Math.round(d);
}
function degToRad(deg) {
    return deg * (Math.PI/180)
}

//Used google maps api documentation to create this
function initMap() {
    var city_1_position = {lat: lat1, lng: lng1};
    var city_2_position = {lat: lat2, lng: lng2};
    var midpoint = {lat: lat3, lng: lng3};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 2,
        streetViewControl: false,
        fullscreenControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.RIGHT_TOP
        },
        center: midpoint
    });

    var city_1_marker = new google.maps.Marker({
        position: city_1_position,
        map: map,
        label: city1_label,
        title: city1_title
    });


    var city_1_infowindow = new google.maps.InfoWindow({
        content: city_1_marker_content + city_1_link
    });

    city_1_marker.addListener('click', function () {
        city_1_infowindow.open(map, city_1_marker);
    });

    city_1_marker.addListener('dblclick', function () {
        map.setZoom(12);
        map.setCenter(city_1_position);
        city_1_infowindow.open(map, city_1_marker);
    });

    var city_2_marker = new google.maps.Marker({
        position: city_2_position,
        map: map,
        label: city2_label,
        title: city2_title
    });

    var city_2_infowindow = new google.maps.InfoWindow({
        content: city_2_marker_content + city_2_link
    });

    city_2_marker.addListener('click', function () {
        city_2_infowindow.open(map, city_2_marker);
    });

    city_2_marker.addListener('dblclick', function () {
        map.setZoom(12);
        map.setCenter(city_2_position);
        city_2_infowindow.open(map, city_2_marker);
    });

    var line = new google.maps.Polyline({
        path: [
            new google.maps.LatLng(lat1, lng1),
            new google.maps.LatLng(lat2, lng2)
        ],
        strokeColor: "#6f9dff",
        strokeOpacity: 1.0,
        strokeWeight: 4,
        map: map
    });

    var midpoint_marker = new google.maps.Marker({
        position: midpoint,
        map: map,
        visible: false
    });


    var line_infowindow = new google.maps.InfoWindow({
        content: line_content1 + calculateDistance(lat1,lng1,lat2,lng2) + line_content2
    });

    line.addListener('click', function () {
        map.setZoom(2);
        map.setCenter(midpoint);
        line_infowindow.open(map, midpoint_marker);
    });
}
