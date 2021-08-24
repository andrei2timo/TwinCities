<?php
/**
 * User: Jacob
 * github.com/coobie
 */
$title = '404';
$currentPage = '404';
require_once __DIR__ . '/includes/config.php';
require  $base_path . '/templates/head.php';
require $base_path . '/templates/header.php';
require $base_path . '/templates/top_nav_bar.php';
require $base_path . '/templates/page_content.php';

?>

<h1 class="page_title">Error 404</h1>
<h2>Oh Dear :(</h2>
<h3>This page does not exist</h3>
<h3></h3>
<h5>This could be a problem our side...</h5>
<h5>But more likely you are to blame.</h5>

<?php require __DIR__ . '/templates/footer.php'; ?>
