<?php

require_once __DIR__ . '/includes/config.php';

//Check city and place of interest is provided in the URL and that they match our data
if (isset($_GET[$get_city]) && isset($_GET[$get_place]))
{
    $twin = $_GET[$get_city];
    $interest = $_GET[$get_place];

    if ($twin == $city1->getName())
    { //City is city 1
        $city = $city1;
        $place;
        foreach ($city->getPlacesOfInterest() as $temp)
        {
            if ($interest == $temp->getName())
            {
                $place = $temp;
                break;
            }
        }
    }
    elseif ($twin == $city2->getName())
    { // City is city 2
        $city = $city2;
        $place;
        foreach ($city->getPlacesOfInterest() as $temp)
        {
            if ($interest == $temp->getName())
            {
                $place = $temp;
                break;
            }
        }
    }
    else
    { //City is not correct
        header("Location: $base_url/404/");
        die();
    }

    if (! isset($place))
    {
        header("Location: $base_url/404/");
        die();
    }

    $title = $city->getName().'-'.$place->getName();
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


//Query the data for the city
$data = simplexml_load_file($base_path.'/data/cities.xml');
$xpath_poi = $data->xpath("/twinning/cities/city[@woeid='".$city->getWoeid()."']/places_of_interest");

$xml = $xpath_poi[0];
//Load the stylesheet
$xsl = simplexml_load_file($base_path.'/templates/place_of_interest.xsl');

//Load the XSLT processor and stylesheet into it
$xslt = new XSLTProcessor;
$xslt->importStylesheet($xsl);
//Set parameters for the stylesheet
$xslt->setParameter('','city_name',$city->getName());
$xslt->setParameter('','poi_name',$place->getName());
$xslt->setParameter('','poi_category',$place->getCategory());
$xslt->setParameter('','base_url',$base_url);
$xslt->setParameter('','image_url',$image_url);
$xslt->setParameter('','get_city',$get_city);
$xslt->setParameter('','get_place',$get_place);
$xslt->setParameter('','url_ending',$url_ending);
$xslt->setParameter('','google_map_key',$google_map_key);
//Load query result as XML and transform it using the XSLT processor
$temp = simplexml_load_string($xml->asXML());
echo($xslt->transformToXml($temp));


?>

    <!-- Others -->
    <div><br>
<?php
if (count($city->getPlacesOfInterest()) > 1) {
    // Look to see if there is any other of the same category in the city
    $temp_poi_category = array();
    foreach ($city->getPlacesOfInterest() as $temp) {
        if ($temp != $place && $temp->getCategory() == $place->getCategory()) {
            array_push($temp_poi_category, $temp);
        }
    }
    if (count($temp_poi_category) > 0) { // Displaying others if there are any
        echo('<strong>Other ' . $place->getCategory() . 's in ' . $city->getName() . '</strong><ul>');
        foreach ($temp_poi_category as $temp) {
            echo('<li><a href="' . $base_url . "place_of_interest" . $url_ending . "?" . $get_city . "=" . $city->getName() . "&" . $get_place . "=" . str_replace(" ", "+", $temp->getName()) . '">' . $temp->getName() . '</a></li>');
        }
        echo('</ul>');
    }
}
    ?>
    </div>


<?php require_once $base_path . '/templates/footer.php'; ?>