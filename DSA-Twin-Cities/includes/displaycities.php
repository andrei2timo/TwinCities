<?php
$title = 'PlacesOfInterest';
$currentPage = 'poi';
require_once __DIR__ . '/config.php';
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php';
?>

<!DOCTYPE html>
<html>
<head>
<style>

	body {
		background-image: url('../lights3.jpg');
	}
.button {
  background-color: #000080;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 50px 100px;
  cursor: pointer;
}

</style>
</head>
<body>

<h2 style="text-align:center">Display the places of interest for each of these 2 cities</h2>


<a href="../Mapping/mappingTorbay.php" class="button">Places of interests for Torbay</a>
<a href="../Mapping/mappingHamelin.php" class="button">Places of interests for Hamelin</a>


</body>
</html>