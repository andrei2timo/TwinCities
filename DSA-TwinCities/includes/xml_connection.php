<?php

require_once "City.php";
require_once "Twinning.php";
require_once "Place_of_Interest.php";
$cities = array(); //Store the cities

$doc = new DOMDocument;

$doc->preserveWhiteSpace = false;
$base_path = "C:/xampp/php/TwinCities/DSA-Twin-Cities";
$doc->load($base_path.'/data/cities.xml'); //Load the data

$xpath = new DOMXPath($doc);

$city_query = '/twinning/cities/city'; //Query for getting the city information

$city_entries = $xpath->query($city_query); //Execute query

// Save basic information about cities
foreach ($city_entries as $city_entry)
{
    $temp_city = new City($city_entry->getElementsByTagName('name')->item(0)->nodeValue);
    $temp_city->setWoeid($city_entry->getAttribute('woeid'));
    $temp_city->setCountry($city_entry->getElementsByTagName('country')->item(0)->nodeValue);
    $temp_city->setCountryCode($city_entry->getElementsByTagName('country_code')->item(0)->nodeValue);
    $temp_city->setLat($city_entry->getElementsByTagName('latitude')->item(0)->nodeValue);
    $temp_city->setLng($city_entry->getElementsByTagName('longitude')->item(0)->nodeValue);
	
    $temp_array_poi = array();

    //Query and loop on places of interest in the city
    $pois = $xpath->query('/twinning/cities/city[name="'.$temp_city->getName().'"]/places_of_interest/place_of_interest');

    foreach ($pois as $poi)
    {
        $temp_poi = new Place_of_Interest($poi->getElementsByTagName('name')->item(0)->nodeValue,$poi->getAttribute('category'));
        array_push($temp_array_poi,$temp_poi);
    }
    $temp_city->setPlacesOfInterest($temp_array_poi);
    array_push($cities,$temp_city);
}

//Find and store information about the twinning
$twinning = new Twinning();

$twinning_entries = $xpath->query('//twinning');

foreach ($twinning_entries as $t)
{
    $twinning->setBanner($t->getElementsByTagName('image')->item(0)->nodeValue);
    $twinning->setDesc($t->getElementsByTagName('description')->item(0)->nodeValue);
    $twinning->setDescSource($t->getElementsByTagName('description_source')->item(0)->nodeValue);
}

?>