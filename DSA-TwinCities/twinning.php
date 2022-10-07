<?php
/**
 * User: Jacob
 * github.com/coobie
 */

$title = 'About the twinning';
$currentPage = 'twinning';
require_once __DIR__ . '/includes/config.php';
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php'; ?>


<h1 class="page_title">The Twinning Between <?php echo($city1->getName() . " and " . $city2->getName()) ?></h1>

<div>
    <h2>What is twinning?</h2>
    <p>Twin towns or sister cities are a form of legal or social agreement between towns, cities, counties,
        oblasts, prefectures, provinces, regions, states, and even countries in geographically and politically
        distinct areas to promote cultural and commercial ties. The modern concept of town twinning, conceived
        after the Second World War in 1947, was intended to foster friendship and understanding between different cultures
        and between former foes as an act of peace and reconciliation, and to encourage trade and tourism. By the 2000s,
        town twinning became increasingly used to form strategic international business links between member cities.
        <a href="https://en.wikipedia.org/wiki/Sister_city">[wikipedia]</a>
    </p>
</div>
<div>
    <h2>About the twinning</h2>
    <p><?php echo($twinning->getDesc()); ?><a href="<?php echo $twinning->getDescSource()?>">[source]</a></p>
</div>

<div>
    <h2>Link between them</h2>
    <?php
    echo ('<ul>');
    $i = 0;
    foreach ($twinning->getPoiJoin() as $p)
    {
        echo('<li><a href="'.$base_url."place_of_interest".$url_ending."?".$get_city."=".$cities[$i]->getName()."&".$get_place."=".str_replace(" ","+",$p->getName()).'">'.$p->getName().' ['.$cities[$i]->getName().']'.'</a></li>');
        $i++;
    }
    echo ('</ul>');
    ?>
</div>
<?php require_once $base_path . '/templates/footer.php'; ?>

<!DOCTYPE html>
<html>
<head>

<style>
	body {
		background-image: url('./lights3.jpg');
}
</style>
</head>

<body>

</body>
</html>