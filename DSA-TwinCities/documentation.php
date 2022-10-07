<?php
/**
 * User: Jacob
 * All of the documentation for the assignment
 * github.com/coobie
 */

$title = 'Documentation';
$currentPage = 'doc';
require_once __DIR__ . '/includes/config.php';
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php';
?>

    <h1 class="page_title">Documentation</h1>
    <div>
        <h2>Content</h2>
        <h4><a href="#ind_doc">Individual Documentation</a></h4>
        <ul>
            <li><a href="#intro">Introduction</a></li>
            <li><a href="#about_city_page">About City page</a></li>
            <li><a href="#about_poi_page">About Place of interest page</a></li>
            <li><a href="#about_rss">About RSS feed/page</a></li>
            <li><a href="#works">How it works (step-by-step)</a>
            <ul>
                <li><a href="#works_city">City</a></li>
                <li><a href="#works_interest">Place of interest</a></li>
                <li><a href="#works_xml_con">xml_connection</a></li>
                <li><a href="#works_weather_con">weather_connection</a></li>
            </ul>
            </li>
        </ul>
        <h4><a href="#group_doc">Group Documentation</a></h4>
        <ul>
            <li><a href="#intro">Introduction</a></li>
            <li><a href="#conceptual_er">Conceptual ER model</a></li>
            <li><a href="#logical_er">Logical ER model</a></li>
            <li><a href="#site_map">Site Map</a></li>
            <li><a href="#file_layout">File Layout</a></li>
            <li><a href="#design">Design Choices</a> - IMPORTANT</li>
            <li><a href="#object_explained">Objects explained</a></li>
            <li><a href="#weather_explained">Weather Explained</a></li>
            <li><a href="#validation">Validation of HTML and RSS</a></li>
        </ul>
    </div>
    <div>
        <h2 id="ind_doc">Individual Documentation</h2>
        <p>
            This is a short report on my individual part of the DSA assignment, I chose
            the part “Refactor the data set using XML and XML-Schema”.
        </p>
        <p>
            This involved refactoring the data in our MySQL database to an XML file.
            This means that I had change the way in which the data is read in.
        </p>
        <p>
            Due to the design of our project this means that I only had to change the code in a couple of places.
            This was in database_connection.php and weather_connection.php as these were the only places that
            interacted with the database.
        </p>
        <p>
            I swapped the database_connection.php file for a new one xml_connection.php which provides
            the same results just that it reads the data (about the cities etc) in from the XML file
            rather than the MySQL database.
        </p>
        <p>
            The weather_connection.php I modified the code to use the XML file but behaves in a similar way.
            The only thing that I needed to remember was to give permissions to the file on the server (CEMS UWE)
            like we did for the quotes worksheet (chmod).
        </p>
        <p>
            Because our project uses PHP objects for the cities and their places of interest,
            I could have left it there as the site was fully functional. However, to try to achieve maximum marks
            I decided to use XSLT to generate parts of the site.
        </p>
        <p>
            These parts are:
            <ul>
                <li>City pages (XML -> HTML)</li>
                <li>Places of interest pages (XML -> HTML)</li>
                <li>RSS feed (XML -> RSS [XML])</li>
            </ul>
        </p>
        <p>
            XSLT is a language for transforming XML documents into other formats.<br>
            This means that the pages will be generated from the XSL stylesheet by the PHP XSLT processor.
        </p>
        <div id="about_city_page">
            <h3>City page</h3>
            <p>
                For the city page the city is passed via HTML get (displayed in the URL) and some PHP code
                works out if this city matches one of ours. If it is valid an XPath query will be made by
                the HTML code looking for the woeid (unique attribute for each city). This will return a valid
                city (checked it is in our data before) and the result on the XPath query needs to be converted
                back to XML. Now the result (in XML format) can be provided to the XSLT processor to apply the
                stylesheet.
            </p>
        </div>
        <div id="about_poi_page">
            <h3>Place of interest page</h3>
            <p>
                For the places of interest, a similar method was used with the only main difference being
                that the place of interest is provided in the URL. As well as this all of the places of
                interest were provided to the stylesheet and then in the stylesheet itself it matches the place
                of interest and shows details on this. The reason for this is so that you have access to all the other
                places of interest so that all of the other places of interest can be listed as links that
                the bottom of the page.
            </p>
            <p>
                In the normal group version, we have a nice section which if you are viewing details about a museum
                in a given city, towards the bottom of the page there will be suggestions to other museums in that
                city (if there is any in our data). Sadly, due to the nature of XSL being based on the concepts of
                functional programming it meant that it was not easy to replicate. Therefore, this section is done
                outside of the XSL stylesheet and instead remains in PHP code. This is why on the page for a place
                of interest on the XML data version of the site this section appears underneath the list of all other
                places of interest whereas on the normal group version it is the other way around.
            </p>
        </div>
        <div id="about_rss">
            <h3>RSS</h3>
            <p>
                For the RSS feed it is transforming the data (in normal well-formed XML) to a valid RSS feed (XML).
                This is conforming to the tags and requirements used by RSS. The stylesheet retrieves the relevant
                information from the data and displays it as RSS. This includes the links to the pages.
            </p>
            <p>
                While using the XSLT processor I had the problem of accessing the base URLS, luckily the
                PHP XSLT processor allows values to be passed into it using setParameter to assign values
                from external code to XSL ‘variables’ (constant). Using this method, I was able to make everything work.
            </p>
        </div>
        <div id="works">
            <h3>How it works step-by-step</h3>
            <p>
                Data is held: /data/cities.xml <br>
                PHP City objects are constructed in /includes/xml_connection.php<br>
                <a href="#object_explained">[See group documentation for more details]</a><br><br>
                XSL stylesheets are held in ‘templates’ folder<br>
            </p>
            <a href="<?php echo 'xsl_process.PNG'; ?>"><img src="<?php echo 'xsl_process.PNG'; ?>" alt="XSL process" width="100%"></a>
            <p>This is a diagrammatic representation of the process of Data to HTML using XSLT.</p>
            <h4 id="works_city">City</h4>
            <ul>
                <li>City in the URL (HTML GET) is checked for whether it exists in the data.
                <ul>
                    <li>Loads the data file in.</li>
                    <li>Query the data for finding the city required. </li>
                    <li>Loads the stylesheet.</li>
                    <li>Sets any parameters (variables) needed in the stylesheet.</li>
                    <li>Takes the result of the query and turns it back into XML.</li>
                    <li>Performs the transformation on the data from the query using the XSLT processor. HTML is returned.</li>
                </ul>
                </li>
            </ul>
            <h4 id="works_interest">Place of interest</h4>
            <ul>
                <li>City and place of interest in the URL (HTML GET) are checked.
                    <ul>
                        <li>Loads the data file in.</li>
                        <li>Query the data for finding the corresponding city.</li>
                        <li>Loads the stylesheet.</li>
                        <li>Sets any parameters for the stylesheet.
                        <ul><li>The place of interest in question is passed in as one of these so we can output the relevant information. </li></ul>
                        </li>
                        <li>Takes the result of the query and turns it back into XML.</li>
                        <li>Performs the transformation on the data from the query using the XLST processor.</li>
                    </ul>
                </li>
            </ul>
            <h4 id="works_rss">RSS</h4>
            <ul>
                <li>Set content type of the page to XML so that a browser displays it as tree structure.</li>
                <li>Load data.</li>
                <li>XPath query just to find root node.</li>
                <li>Load stylesheet.</li>
                <li>Sets any parameters for the stylesheet</li>
                <li>Load result of query into XSLT processor.</li>
                <li>Result is an RSS feed.</li>
            </ul>
            <h4 id="works_xml_con">xml_connection</h4>
            <p>
                I used the PHP DOM for this. Although similar principle as the ones above.
                <ul>
                <li>Load data file.</li>
                <li>Query the data.</li>
                <li>Extract required data and put values into objects (City, Place_of_interest and Twinning).</li>
                </ul>
            </p>
            <h4 id="works_weather_con">weather_connection</h4>
            <ul>
                <li>Loads data in.</li>
                <li>Query the data using the city provided woeid. </li>
                <li>Store the results to weather objects. </li>
                <li>Check the timestamps of them (<a href="#weather_explained">see main documentation</a>).
                <ul>
                    <li>OLD DATA</li>
                    <li>Reads new data from open weather (JSON).</li>
                    <li>Replace data in objects.</li>
                    <li>Set data in XML document equal to the data from open weather.</li>
                    <li>Save XML file back with updated weather.</li>
                </ul>
                </li>
            </ul>
        </div>
    </div>

    <div>
        <h2 id="group_doc">Group documentation</h2>
        <p>This excludes any of the individual tasks.</p>
        <div id="intro">
            <h3>Introduction</h3>
            <p>For this assignment, we were tasked with building a data driven web application that uses external
                API’s and local data storage to encourage interest in twining. As we know, twinning is a form of legal
                or social agreement between towns, cities and regions in geographically distinct areas to
                promote cultural and commercial ties.
            </p>
            <p>
                The group tasks that had to be completed included designing and constructing conceptual and logical
                ER models which highlight the various entities and attributes of the project and the relationships
                between them. Database implementation was also required which entails implementing and populating
                the database on the UWE/CEMS MySQL server. Mapping and weather APIs were developed to show maps and
                current/forecast weather for our chosen cities – Torbay and Hamelin. Finally, an XML file holding
                application-wide data was constructed, along with an RSS feed which shows all data regarding the twin
                cities and places of interest currently held in the database.
            </p>
        </div>
        <div id="conceptual_er">
            <h3>Conceptual ER model</h3>
            <a href="<?php echo $base_url.'Planning/conceptual_model.png'; ?>"><img src="<?php echo $base_url.'Planning/conceptual_model.png'; ?>" alt="Conceptual ER model" width="100%"></a>
            <p>
                The conceptual ER model. Note data types are not shown and
                relationships are not fully broken down. Primary key is <strong style="color:#C92D39">bold_red</strong> and foreign key is <i style="color:#77C2E7">italic_blue</i>.
            </p>
            <p>
                Basic relationship is shown with city having many places of interest.
            </p>
            <p>
                Although technically a city can have more than one twinning for the purposes of our system only one 'twinning' is shown.
            </p>
            <p>
                Images are just in the relevant tables in this model and have not been extracted to another table.<br>
                City has both a city_id and woeid.<br>
                Each city has weather and a forecast of the weather.

            </p>
        </div>
        <div id="logical_er">
            <h3>Logical ER model</h3>
            <a href="<?php echo $base_url.'Planning/logical_model.png'; ?>"><img src="<?php echo $base_url.'Planning/logical_model.png'; ?>" alt="Logical ER model" width="100%"></a>
            <p>
                The logical ER model. This includes more details about keys and data types.
            </p>
            <p>
                Changes since conceptual model:
            <ul>
                <li>city_id and woeid have been merged so the city_id is the woeid.</li>
                <li>images have been moved to separate table which contains alt text and the location of the image (image_link).</li>
                <li>Places of interest can be a link between the cities (noted by the foreign key twinning_id in places_of_interest). This is optional.</li>
                <li>weather and forecast have been merged into one table, so weather can have weather (forecast_id) note
                    that forecast_id is not compulsory as forecast does not have a forecast.  </li>
            </ul>
            </p>
        </div>
        <div id="site_map">
            <h3>Site Map</h3>
            <a href="<?php echo $base_url.'Planning/site_map.png'; ?>"><img src="<?php echo $base_url . 'Planning/site_map.png'; ?>" alt="Site map" width="100%"></a>
        </div>
        <div id="file_layout">
            <h3>File Layout</h3>
            <a href="<?php echo $base_url.'Planning/file_layout.png'; ?>"><img src="<?php echo $base_url . 'Planning/file_layout.png'; ?>" alt="file layout" width="100%"></a>
        </div>
        <div id="design">
            <h3>Design Choices</h3>
            <p>We chose to only have one image per city and for each place of interest. It would have been easy to
                introduce more but we decided that it was not needed. Also, having more
                images is achieved by the Flickr individual task.
            </p>
            <p>
                At the moment only two cities are supported. It would be possible to introduce more
                but a couple of parts would need to be changed such as the navigation bar.
            </p>
            <p>
                Each city page is got to by HTML GET passing in the name of the city (/city/?city=Torbay).
                We acknowledge that this would not necessarily be unique for example if instead of Torbay and Hamelin
                we had done Torbay [UK] and Torbay [VA, US]. However, the city name is far more human compliant
                than the woeid for the city (what we would replace it with). If necessary, this could be changed.<br>
                This is similar for the place of interest (/place_of_interest/?city=Torbay&interest=HMS+Warrior)
                although this is more likely to be unique unless there is two places with the same name and the same interest
                name or two interests with the exact same name in the same city. Going back to the previous example,
                if there is a cathedral in both Torbay cities both called 'Torbay cathedral'.

            </p>
        </div>
        <div id="object_explained">
            <h3>Objects Explained</h3>
            <p>
                Our system has been designed so that none of the data/information has been hard-coded. The way that it is
                done means that if we were to swap the data in the database with another two cities the site would work.
            </p>
            <p>
                The system uses objects to hold all the information once it has been pulled from the database.
                These objects are City, Place_of_interest, Twinning and Weather. All of these classes have getters
                and setters. These classes are held in ‘includes’ folder.
            </p>
            <p>
                This means that the information on the pages are populated by the objects and not straight from the
                database. This means that the database is only accessed once per page.
            </p>
            <p>
                It also means that if the database (type of database) was changed (including Jacob refactoring
                the data to XML) only the weather_connection.php and database_connection.php require any modification.
            </p>
        </div>
        <div id="weather_explained">
            <h3>Weather Explained</h3>
            <a href="<?php echo $base_url.'Planning/weather_explained.png'; ?>"><img src="<?php echo $base_url . 'Planning/weather_explained.png'; ?>" alt="Flowchart of the weather system" width="100%"></a>
            <p>
                The weather is displayed on each of the city pages.<br>
                The weather we have is current weather and the next forecast.<br>
                The weather data is provided by open weather. The free api is limited to 60 calls per minute (which we are far beneath).
            </p>
            <p>
                The weather system on our site makes use of ajax. The page makes a get request and calls another PHP file
                in includes called weather_connection.php (This is done when the page is first loaded or when the user
                of the site clicks ‘reload weather’). Three things are provided to the method (the base URL, the city
                name and the country). The city name and country code are attached using HTML GET.
            </p>
            <p>
                In weather_connection.php the city is checked to see whether it is one of ours (in db checked against objects).
            </p>
            <p>
                If it is one of ours then the data will be loaded from the database (weather table) where the city_woeid
                is equal to our city’s woeid. Firstly, we pull the ‘current weather’ which has a forecast
                so the forecast_id is not null. We read this data from the database into our weather object. A similar
                statement is used for the forecast but instead the forecast_id is null. These weather objects are then
                set for city.
            </p>
            <p>
                Then the current time is checked against the saved time we fetch the weather every hour unless the current
                time is greater than the forecast time. For example, if the weather was last cached at 11:02 then the
                next time it would be updated would be an hour later (on the same day). However, if when we cached the
                weather at this time the next forecast was for 12:00 then at 12:00 the weather would be pulled and cached
                again (two minutes before if it was only being done every hour). Note that the user would have to refresh
                the page or press reload the weather for this to happen.
            </p>
            <p>
                If the weather is recent then the weather is displayed. Otherwise, the api is called and the data is decoded
                from JSON and put into the weather objects. If the JSON file is missing the data, then defaults are set,
                and a message will be displayed to the user (this does not happen too often it is mainly the wind direction
                that is missing). The time that the weather was pulled is stored to the objects then the database is
                updated using update statements (so replaces existing data).
            </p>
            <p>
                <strong>Note the times are displayed in GMT not local time.</strong>
            </p>
        </div>
        <div id="validation">
            <h3>Validation of RSS and HTML</h3>
            <p>We have validated the site using the following:</p>
            <ul>
                <li><a href="https://validator.w3.org/">HTML Validator</a></li>
                <li><a href="https://validator.w3.org/feed/">RSS Validator</a></li>
            </ul>
            <p>Outcome - our site is valid HTML and our RSS feed is also valid.</p>
        </div>
    </div>




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