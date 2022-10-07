<?php
$title = 'MappingTorbay';
$currentPage = 'torbay';
require_once 'C:/xampp/php/TwinCities/DSA-Twin-Cities/includes/config.php';
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php'; 
    // imports everything from the access_database.php file
    // This connects to the database so that the script can query and pull data
    include 'access_database.php';

    // Imports the required configurations
    require_once('C:/xampp/php/TwinCities/DSA-Twin-Cities/includes/configuration.php');

    // Gets the API key from the configuration file
    $bing_maps_api_key = "AtI99eYl4nVkKrwBZU6M27NZvG4tsbXqLCq-dywDtbKWpNAHrDrZZPthg2BSmg3j";

    // Queries the database to pull all the rows where the woeid is equal to 3991
    $sql_query = "SELECT * FROM city WHERE woeid = 3991";

    // Excutes an SQL statement and returns a 
    // results set in the form of a PDOStatement object 
    // that reflect the sql query 
    $query = $database->query($sql_query);

    // Returns an array indexed by the column names stored in the database
    $query->setFetchMode(PDO::FETCH_ASSOC);

    // Creates an array containing all the columns and data
    $city_data = $query->fetchAll();


    // Queries the database to pull all the rows from the 
    // place_interest table within the range of 0 to 10
    $sql_query_one = "SELECT * FROM place_interest limit 10";

    // Query for the places of interest
    $query_one = $database->query($sql_query_one);
    $query_one->setFetchMode(PDO::FETCH_ASSOC);

    // Stores the individual place of interest data
    
    $places_data = $query_one->fetchAll();


    // Queries the database to pull all the rows from the 
    // catagories table within the range of 0 to 10
    $sql_query_two = "SELECT * FROM catagories limit 10";

    // Query for the catagory icons of each 
    $query_two = $database->query($sql_query_two);
    $query_two->setFetchMode(PDO::FETCH_ASSOC);

    // Stores the links to the icons
    $venue_data = $query_two->fetchAll();


    // Queries the database to pull the images for the places of interest
    $sql_image_query = "SELECT * FROM photo limit 10";

    // Query for the images of each place of interest
    $query_image = $database->query($sql_image_query);
    $query_image->setFetchMode(PDO::FETCH_ASSOC);

    // Stores the links to the images
    $image_data = $query_image->fetchAll();


?>

<!DOCTYPE html>
<head>
    <style type='text/css'>
                body{
                    margin:0;
                    padding:0;
                    overflow:hidden;
                    font-size: 14px;
                    font-family:'Segoe UI',Helvetica,Arial,Sans-Serif;
                    background-image: url('../lights3.jpg');
                }

                /* For the main page title */
                .title {
                    position:absolute;
                    top:10px; 
                    font-size: 25px;
                    right:44%;
                    color: white;
                }

                /* For the actual map */
                div.torbayMap{
                    position: relative;
                    top: 20px;
                    left: 50px;
                    width: 950px; 
                    height: 400px;
                    z-index: 1; /*Brings the map to the back of the page*/
                }

                /* For the bullet points at the bottom of the webpage */
                .places {
                    position: relative;
                    left: 100px;
                }
                    
            }

    </style>
</head>
<body>
    
    <!-- Sets a Page Title -->
    <div class='title'> </div>

    <!-- The map -->
    <div class='torbayMap' id='torbayMap'></div>

    <script type='text/javascript'>
        /*
            Function Name: displayMap
            Argument List: N/A
            Description: Creates a new map for the city of Torbay,
                        It also adds pins to the top 10 places of
                        interest.
        */
        function displayMap() 
        {
            // Passes the php version of the api key to a JS variable
            var bing_maps_api_key = "<?php echo $bing_maps_api_key;?>";

            // Stores the coordinates 50.4523 (city_latitude), -3.5568 (city_longitude)
            var city_latitude = "<?php echo $city_data[0]['latitude'];?>";
            var city_longitude = "<?php echo $city_data[0]['longitude'];?>";

            // Creates a new instance of a map using the Bing Maps API and assigns it an ID
            torbayMap = new Microsoft.Maps.Map(document.getElementById("torbayMap"),
            {
                // API Key
                credentials: bing_maps_api_key,
                // sets the centre of the map
                center: new Microsoft.Maps.Location(city_latitude, city_longitude)
            });

            // creates an overlay on top of the map that allows pushpins to be placed
            pushpinLayer = new Microsoft.Maps.Layer();

            // Zooms in on a specific area instead of a vast map
            torbayMap.setView({zoom: 12});

            // creates an overlay that alows a box to appear on a pushpin
            var infoboxLayer = new Microsoft.Maps.EntityCollection();
            torbayMap.entities.push(infoboxLayer); //adds to the overlay

            // Adds a popup box above the pin 
            label = new Microsoft.Maps.Infobox(torbayMap.getCenter(), {
                // Hides the labels 
                visible: false,
                showPointer: false,
                showCloseButton: false,
                offset: new Microsoft.Maps.Point(-75, 10)
            });

            // Adds the label to the map
            label.setMap(torbayMap);
            // Adds the label to to the information layer
            infoboxLayer.push(label);

            // stores the php arrays containing the data from the database
            var placesData = JSON.parse(`<?= json_encode($places_data)?>`);
            var catagoryData = JSON.parse(`<?= json_encode($venue_data)?>`);
            

            // Calls placesOfInterest function to make a pin for Babbacombe model village
            // Uses the array values of both placesData and catagoryData in order to provide values to the function
            placesOfInterest(placesData[0]['latitude'], placesData[0]['longitude'], catagoryData[0]['interest_icon'],
            placesData[0]['name'], placesData[0]['short_description']);
            

            // Calls placesOfInterest function to make a pin for Kents Cavern
            placesOfInterest(placesData[1]['latitude'], placesData[1]['longitude'], catagoryData[1]['interest_icon'], 
            placesData[1]['name'], placesData[1]['short_description']);


            // Calls placesOfInterest function to make a pin for Torre Abbey Museum
            placesOfInterest(placesData[2]['latitude'], placesData[2]['longitude'], catagoryData[2]['interest_icon'], 
            placesData[2]['name'], placesData[2]['short_description']);


            // Calls placesOfInterest function to make a pin for Cockington Court
            placesOfInterest(placesData[3]['latitude'], placesData[3]['longitude'], catagoryData[3]['interest_icon'], 
            placesData[3]['name'], placesData[3]['short_description']);


            // Calls placesOfInterest function to make a pin for Oddicombe Beach
            placesOfInterest(placesData[4]['latitude'], placesData[4]['longitude'], catagoryData[4]['interest_icon'],
            placesData[4]['name'], placesData[4]['short_description']);


            // Calls placesOfInterest function to make a pin for Babbacombe Cliff Railway
            placesOfInterest(placesData[5]['latitude'], placesData[5]['longitude'], catagoryData[5]['interest_icon'], 
            placesData[5]['name'], placesData[5]['short_description']);


            // Calls placesOfInterest function to make a pin for South Devon University
            placesOfInterest(placesData[6]['latitude'], placesData[6]['longitude'], catagoryData[6]['interest_icon'], 
            placesData[6]['name'], placesData[6]['short_description']);


            // Calls placesOfInterest function to make a pin for The Imperial Hotel
            placesOfInterest(placesData[7]['latitude'], placesData[7]['longitude'], catagoryData[7]['interest_icon'], 
            placesData[7]['name'], placesData[7]['short_description']);


            // Calls placesOfInterest function to make a pin for Princess Theatre
            placesOfInterest(placesData[8]['latitude'], placesData[8]['longitude'], catagoryData[8]['interest_icon'], 
            placesData[8]['name'], placesData[8]['short_description']);


            // Calls placesOfInterest function to make a pin for Paignton Zoo
            placesOfInterest(placesData[9]['latitude'], placesData[9]['longitude'], catagoryData[9]['interest_icon'], 
            placesData[9]['name'], placesData[9]['short_description']);

        }

        /*
            Function Name: placesOfInterest
            Argument List: long, lat, icon, title, page
            Description: Creates pushpins on the map at cetain
                        points of interest in torbay.
        */
        function placesOfInterest(lat, long, icon, title, description)
        {
            // Creates a new pushpin and sets its location to the inputted longitude and latitude
            // var pin1 = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(long, lat), 
            var pin1 = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(lat, long), 
            {
                // Uses the passed icon as the pushpin icon
                icon: icon,
                // Sets the anchor point of the pushpin so this places the pushpin upwards by 10
                anchor: new Microsoft.Maps.Point(0, 10),

                // Allows the small area around the pushpin to be clicked on
                roundClickableArea: true
            });

            // Sets the name and description of the selected pushpin
            pin1.metadata = {
                title: title,
                description: description
            };

            // Adds functionality to each pushpin if either hovered over or clicked
            Microsoft.Maps.Events.addHandler(pin1, 'mouseover', mouseoverPushpin);
            Microsoft.Maps.Events.addHandler(pin1, 'mouseout', closeTooltip);
            Microsoft.Maps.Events.addHandler(pin1, 'click', clickOverlay);
            // Microsoft.Maps.Events.addHandler(pin1, 'click', function enlarge() {window.location = page;});

            // Adds the pushpin to the layer of pushpins above the map layer
            pushpinLayer.add(pin1);

            // Adds the pushpin to the map
            torbayMap.layers.insert(pushpinLayer);

        }

        // Sets the size of the white box behind each pushpin
        var labelBackground = '<div style="background-color:white;height:50px;width:160px;padding:5px;text-align:center"><b>{title}\n{description}</b></div>';

        /*
            Function Name: mouseoverPushpin
            Argument List: e
            Description: An event function that makes a 
                        label appear with the pushpin's 
                        title and description.
        */

        function mouseoverPushpin(e) {
            //Make sure the infobox has metadata to display.\n
            if (e.target.metadata) {
                //Set the infobox options with the metadata of the pushpin.
                label.setOptions({
                    // Sets the location of the text
                    location: e.target.getLocation(),
                    // Changes the part of the labelbackground that says {title}\n{description} 
                    // to the title of the pin and description
                    htmlContent: labelBackground.replace('{title}\n{description}', e.target.metadata.title + ":\t" + e.target.metadata.description),
                    visible: true
                });
            }
        }

        /*
            Function Name: mouseoverPushpin
            Argument List: 
            Description: An event function that makes a 
                        label disappear.
        */

        function closeTooltip() {
            //Close the tooltip and clear its content.
            label.setOptions({
                visible: false
            });
        }
       

        /*
            Function Name: clickOverlay
            Argument List: e
            Description: An event function that makes an
                         overlay appear over the map,
                         that shows all the individual
                         places of interest and their
                         description.
        */ 

        function clickOverlay(e)
        {
            // stores the php arrays containing the data from the database
            var placesData = JSON.parse(`<?= json_encode($places_data)?>`);
            var imageData = JSON.parse(`<?= json_encode($image_data)?>`);
            
            // Creates a new DOM element for the overlay
            var overlay = document.createElement('overlays');

            // Sets the DOM element's id 
            overlay.id = "::cover";

            // Sets the style for the overlay element and its children
            overlay.style.cssText = 'position: absolute;top: 0%;left: 0;width: 100%;height: 100%;z-index: 10;background-color: rgba(0,0,0,0.5);font-size:40px;color: white;text-align: center;padding: 160px 0;';

            // Checks to see what pushpin has been selected
            switch(e.target.metadata.title)
            {
                // If the Babbacombe Model Village pushpin was pressed
                case 'Babbacombe Model Village':
                    // Create a new DOM element to store the places of interest images
                    var image = document.createElement("IMG");

                    // Sets the image data based on the data stored in the database
                    // This is linked to the photo path location
                    image.setAttribute("src", imageData[0]['place_photo']);
                    // The image's place of interest name 
                    image.setAttribute("alt", imageData[0]['place_title']);

                    // Sets the style for the image element
                    image.style.cssText = 'position:relative; bottom: 5%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    
                    // Adds the image DOM element to the overlay DOM element as a child
                    overlay.appendChild(image);

                    // Creates text node elements based on the data within the database 
                    // These will create nodes for the popup title and the actual place of interest description
                    var title = document.createTextNode(imageData[0]['place_title']+": ");
                    var text = document.createTextNode(placesData[0]['full_description']);

                    // Adds the text nodes to the overlay DOM element
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    
                    // Ends the switch case
                    break;

                // If the Kents Cavern pushpin was pressed
                case 'Kents Cavern':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[1]['place_photo']);
                    image.setAttribute("alt", imageData[1]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[1]['place_title']+": ");
                    var text = document.createTextNode(placesData[1]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the Torre Abbey Museum pushpin was pressed
                case 'Torre Abbey Museum':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[2]['place_photo']);
                    image.setAttribute("alt", imageData[2]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[2]['place_title']+": ");
                    var text = document.createTextNode(placesData[2]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the Cockington Court pushpin was pressed
                case 'Cockington Court':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[3]['place_photo']);
                    image.setAttribute("alt", imageData[3]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[3]['place_title']+": ");
                    var text = document.createTextNode(placesData[3]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;

                // If the Oddicombe Beach pushpin was pressed
                case 'Oddicombe Beach':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[4]['place_photo']);
                    image.setAttribute("alt", imageData[4]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[4]['place_title']+": ");
                    var text = document.createTextNode(placesData[4]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the Babbacombe Cliff Railway pushpin was pressed
                case 'Babbacombe Cliff Railway':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[5]['place_photo']);
                    image.setAttribute("alt", imageData[5]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 50%; height: 50%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[5]['place_title']+": ");
                    var text = document.createTextNode(placesData[5]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the South Devon University pushpin was pressed
                case 'South Devon University':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[6]['place_photo']);
                    image.setAttribute("alt", imageData[6]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 42%; height: 42%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[6]['place_title']+": ");
                    var text = document.createTextNode(placesData[6]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the The Imperial Hotel pushpin was pressed
                case 'The Imperial Hotel':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[7]['place_photo']);
                    image.setAttribute("alt", imageData[7]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 42%; height: 42%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[7]['place_title']+": ");
                    var text = document.createTextNode(placesData[7]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the Princess Theatre pushpin was pressed
                case 'Princess Theatre':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[8]['place_photo']);
                    image.setAttribute("alt", imageData[8]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 42%; height: 42%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[8]['place_title']+": ");
                    var text = document.createTextNode(placesData[8]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;
                
                // If the Paignton Zoo pushpin was pressed
                case 'Paignton Zoo':
                    var image = document.createElement("IMG");
                    image.setAttribute("src", imageData[9]['place_photo']);
                    image.setAttribute("alt", imageData[9]['place_title']);
                    image.style.cssText = 'position:relative; bottom: 2%;margin-left: auto;margin-right: auto; display: block; width: 42%; height: 42%;z-index: 1;';
                    overlay.appendChild(image);

                    var title = document.createTextNode(imageData[9]['place_title']+": ");
                    var text = document.createTextNode(placesData[9]['full_description']);
                    overlay.appendChild(title);
                    overlay.appendChild(text);
                    break;

                // This only occurs if there was an change in the 
                // places of interest table in the database,
                // This stops the overlay from appearing
                default:
                    overlay.style.display = "none";

            }
            
            // A event listener used to check if anywhere on the overlay has been clicked
            overlay.addEventListener('click', function () {
                // Hides the overlay and all of its children
                overlay.style.display = "none";
            });

            // Adds the overlay DOM element to the body tag DOM
            document.body.appendChild(overlay);

        }



    </script>

    <!-- stops the connection to the database -->
    <?php 
        $database->connection = null;
    ?>

    <!-- Used for the bullet points at the bottom of the page -->
    <div class="Places">
        
        <!-- A list of places of interest and their CSS -->
        <ul style="margin-top: 180px; margin-left: 42px; width:15%; float: left; color: white;font-size: 30px;">
            <li>Babbacombe Model Village</li>
            <li>Kents Cavern</li>
        </ul>

        <ul style="margin-top: 180px; margin-left: 42px; width:15%; float: left; color: white;font-size: 30px;">
            <li>Torre Abbey Museum</li>
            <li>Cockington Court</li>
        </ul>

        <ul style="margin-top: 180px; margin-left: 42px; width:15%; float: left; color: white;font-size: 30px;">
            <li>Oddicombe Beach</li>
            <li>Babbacombe Cliff Railway</li>
        </ul>

        <ul style="margin-top: 180px; margin-left: 42px; width:15%; float: left; color: white;font-size: 30px;">
            <li>South Devon University</li>
            <li>The Imperial Hotel</li>
        </ul>

        <ul style="margin-top: 180px; margin-left: 42px; width:15%; float: left; color: white; font-size: 30px;">
            <li>Princess Theatre</li>
            <li>Paignton Zoo</li>
        </ul>
    </div>

    <!-- This allows for the use of the Bing Maps API -->
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=displayMap'></script>

</body>
</html>
<?php require_once 'C:/xampp/php/TwinCities/DSA-Twin-Cities/templates/footer.php'; ?>