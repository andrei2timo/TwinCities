<?php


$dsa_config_xml = simplexml_load_file(__DIR__ . "/dsa_config.xml") or die ("Error");
require_once __DIR__ . "/City.php";
require_once __DIR__ . "/Place_of_Interest.php";
require_once __DIR__ . "/Weather.php";
require_once __DIR__ . "/Twinning.php";

// Gets
$get_city = (string) $dsa_config_xml->addressing->get_city;
$get_place = (string) $dsa_config_xml->addressing->get_place_of_interest;

// Difference between dev and live
$host_;

switch ($_SERVER["HTTP_HOST"])
{
    case "localhost:8080":
        $host_= $dsa_config_xml->environment->dev;
        break;
    case "isa.cems.uwe.ac.uk":
        $host_=$dsa_config_xml->environment->live;
        break;
    default:
        die("ERROR - HTTP HOST IS NOT VALID");
}

$base_url = $host_->base_url;
$base_path = $host_->base_path;
$url_ending = $host_->url_end;
$server_name = $host_->my_sql->server;
$database = $host_->my_sql->db;
$db_username = $host_->my_sql->un;
$db_pass = $host_->my_sql->pw;

$image_url = $dsa_config_xml->addressing->images_address;

require __DIR__ . "/xml_connection.php";

$google_map_key = $dsa_config_xml->map_api_key;
$open_weather_key = $dsa_config_xml->weather_api_key;

if (count($cities) != 2) die("No more than two (2) cities are supported currently");

$city1 = $cities[0];
$city2 = $cities[1];

?>
