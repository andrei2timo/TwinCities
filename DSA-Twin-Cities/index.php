<?php

$title = 'Home';
$currentPage = 'index';
require_once __DIR__ . '/includes/config.php';
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php'; 

?>

    <h1 class="page_title">DSA-Twin Cities</h1>
    <h2>Twinning Between <?php echo($city1->getName().' and '.$city2->getName());?></h2>
    <p>
        <a href="twinning.php">For more information on the twinning</a>
    </p>
    <div id="map"></div>
<script>
    var lat1 = <?php echo($city1->getLat()); ?>;
    var lng1 = <?php echo($city1->getLng()); ?>;
    var lat2 = <?php echo($city2->getLat()); ?>;
    var lng2 = <?php echo($city2->getLng()); ?>;

    var city1_label = "<?php echo $city1->getName()[0];?>";
    var city1_title = "<?php echo $city1->getName() . ", " . $city1->getCountryCode(); ?>";
    var city_1_marker_content = "<strong><?php echo($city1->getName().', '.$city1->getCountry()); ?></strong><br>";
    var city_1_link = '<br><a href="<?php echo($base_url."city".$url_ending."?".$get_city."=".$city1->getName()."");?>"><?php echo ("More info on ".$city1->getName());?></a>';

    var city2_label = "<?php echo $city2->getName()[0];?>";
    var city2_title = "<?php echo $city2->getName() . ", " . $city2->getCountryCode(); ?>";
    var city_2_marker_content = "<strong><?php echo($city2->getName().', '.$city2->getCountry()); ?></strong><br>";
    var city_2_link = '<br><a href="<?php echo($base_url."city".$url_ending."?".$get_city."=".$city2->getName()."");?>"><?php echo ("More info on ".$city2->getName());?></a>';
    var line_content1 = "<?php echo $city1->getName() . " & " . $city2->getName(); ?>" + "<br>Distance: ";
    var line_content2 = "km (approx)<br><a href='<?php echo($base_url.'twinning'.$url_ending); ?>'>More on the twinning</a>";

</script>
<script src="<?php echo($base_url.'scripts/main_map.js') ?>"></script>
    <script async defer
             src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_key;?>&callback=initMap">
    </script>

<?php require_once $base_path . '/templates/footer.php'; ?>

<!DOCTYPE html>
<html>
<head>

<style>
	body {
		background-image: url('lights3.jpg');
}
</style>
</head>

<body>

</body>
</html>