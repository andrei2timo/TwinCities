<?php
/**
 * User: Jacob
 * Date: 07/02/2018
 * github.com/coobie
 */

$title = 'About us';
$currentPage = 'aboutus';
require_once __DIR__ . '/includes/config.php';
require  $base_path . '/templates/head.php';
require $base_path . '/templates/header.php';
require $base_path . '/templates/top_nav_bar.php';
require $base_path . '/templates/page_content.php'; ?>


    <h1 class="page_title"><?php echo $title; ?></h1>
    <ul>
        <h3>Data, Schemas & Applications 2020/21</h3>
        <h4><a href="https://fetstudy.uwe.ac.uk/~p-chatterjee/2020-21/modules/dsa/assignment/" target="_blank">Twin Towns and Sister Cities</a></h4>
        <p>Group details:</p>
        <table id="group_members">
            <tr>
                <th>Name</th>
                <th>GitHub</th>
                <th>Individual Tasks</th>
            </tr>
            <tr>
                <td>Andrei</td>
                <td><a href="https://github.com/andrei2timo">andrei2timo</a></td>
                <td>Refactor the data set using XML and XML-Schema</td>
            </tr>
            <tr>
                <td>Josiah</td>
                <td><a href="https://github.com/JosiahM42">JosiahM42</a></td>
                <td>Build and integrate a comments widget using local data & the Twitter API</td>
            </tr>
            <tr>
                <td>Lisa</td>
                <td><a href="https://github.com/Liisa101">Liisa101</a></td>
                <td>Refactor the front-end to be responsive.</td>
            </tr>
			<tr>
                <td>Alex</td>
                <td><a N/A >N/A</a></td>
                <td>Document the code and the system</td>
            </tr>
        </table>
    </ul>

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