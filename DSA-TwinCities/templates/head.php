<?php
/**
 * User: Jacob
 * Date: 07/02/2018
 * github.com/coobie
 */

require_once __DIR__ . "../../includes/config.php";

$style_address = $base_url . "stylesheets";
?>
<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title><?php echo($title); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type = "text/css" href="<?php echo $style_address;?>/header.css.php"/>
        <link rel="stylesheet" type = "text/css" href="<?php echo $style_address;?>/footer.css"/>
        <link rel="stylesheet" type = "text/css" href="<?php echo $style_address;?>/top_nav_bar.css"/>
        <link rel="stylesheet" type = "text/css" href="<?php echo $style_address;?>/page_content.css"/>
        <link rel="stylesheet" type = "text/css" href="<?php echo $style_address;?>/city.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="https://www.sportekevents.com/wp-content/uploads/2017/11/world-wide-web-clipart-world-wide-web-png-images-transparent-free-download-pngmart-model-coloring-pages-150x150.png">
    </head>
