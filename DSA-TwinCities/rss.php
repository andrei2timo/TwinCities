<?php

require_once __DIR__ . "/includes/config.php";

//The content type so that a browser displays the data as a tree structure
header('Content-Type: application/xml');

//Load data
$data = simplexml_load_file($base_path.'/data/cities.xml');

//XPath query (only getting root node)
$xpath_rss = $data->xpath("/twinning");
$xml = $xpath_rss[0];

//Load stylesheet
$xsl = simplexml_load_file($base_path.'/templates/rss.xsl');

//XLST processor
$xslt = new XSLTProcessor;
$xslt->importStylesheet($xsl);
//Set parameters for processor
$xslt->setParameter('','base_url',$base_url);
$xslt->setParameter('','image_url',$image_url);
$xslt->setParameter('','get_city',$get_city);
$xslt->setParameter('','get_place',$get_place);
$xslt->setParameter('','url_ending',$url_ending);
$xslt->setParameter('','current_time',gmdate(DATE_RFC822));

//Load query result as XML into XSLT processor
$temp = simplexml_load_string($xml->asXML());
echo($xslt->transformToXml($temp));

?>