<?php


require_once __DIR__ . '/includes/config.php';

//Check city is provided in the URL and that it is one of the ones we are using
if (isset($_GET[$get_city]))
{
    $twin = $_GET[$get_city];

    if ($twin == $city1->getName())
    { //City is city 1
        $city = $city1;

    }
    elseif ($twin == $city2->getName())
    { // City is city 2
        $city = $city2;
    }
    else
    { //City is not correct
        header("Location: $base_url/404/");
        die();
    }
    $title = $city->getName();
    $currentPage = $city->getName();
}
else
{
    header("Location: $base_url/404/");
    die();
}

require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php';

//Query the data
$data = simplexml_load_file($base_path.'/data/cities.xml');
$xpath_city = $data->xpath("/twinning/cities/city[@woeid='".$city->getWoeid()."']");

$xml_city = $xpath_city[0];
$xsl_city = simplexml_load_file($base_path.'/templates/city.xsl');

//XSLT processor
$xslt = new XSLTProcessor;
//Set stylesheet and parameters
$xslt->importStylesheet($xsl_city);
$xslt->setParameter('','base_url',$base_url);
$xslt->setParameter('','image_url',$image_url);
$xslt->setParameter('','get_city',$get_city);
$xslt->setParameter('','get_place',$get_place);
$xslt->setParameter('','url_ending',$url_ending);
$xslt->setParameter('','google_map_key',$google_map_key);
//Load XML result of the query into the processor
$temp = simplexml_load_string($xml_city->asXML());
echo($xslt->transformToXml($temp));

?>
    <script src="<?php echo($base_url.'scripts/weather.js') ?>"></script>
   <script> makeGetRequest(<?php echo("'".$base_url."',"."'".$city->getName()."','".$city->getCountryCode()."')");?>;</script>

<script>document.getElementById("city_static_map").innerHTML = '<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo($city->getLat().','.$city->getLng()); ?>&zoom=13&maptype=hybrid&format=png&size=640x640&key=<?php echo($google_map_key);?>" alt="Static map of <?php echo($city->getName());?>" id="static_map_image"/>'</script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_key ?>&callback=initCityMap">
    </script>
<?php require_once $base_path . '/templates/footer.php'; ?>