<?php
header("Content-type: text/css; charset: UTF-8");

require_once __DIR__ . "../../includes/config.php";
$banner = $twinning->getBanner();
?>


.header {
    background-image: url("<?php echo($banner); ?>");

    -ms-background-position-x: center;
    -ms-background-position-y: center;
    background-position: center center;

    /* scale bg image proportionately */
    background-size: cover;
    height: 200px;
    padding: 20px;
    text-align: center;
    color: white;
}