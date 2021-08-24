/**
 * Code from worksheet 14
 */


function createRequestObject() {
    var tmpXmlHttpObject;

    //depending on what the browser supports, use the right way to create the XMLHttpRequest object
    if (window.XMLHttpRequest) {
        // Mozilla, Safari would use this method ...
        tmpXmlHttpObject = new XMLHttpRequest();

    } else if (window.ActiveXObject) {
        // Old IE would use this method ...
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return tmpXmlHttpObject;
}
//call the above function to create the XMLHttpRequest object
var http = createRequestObject();
function makeGetRequest(base_url,city_name, city_country) {
    //make a connection to the server ... specifying that you intend to make a GET request
    //to the server. Specifiy the page name and the URL parameters to send
    //Uses weather_connection.php passing the city and the country code
    http.open('get', base_url+'includes/weather_connection.php?city=' + city_name + '&country='+city_country);

    //assign a handler for the response
    http.onreadystatechange = processResponse;

    //actually send the request to the server
    http.send(null);
}
function processResponse() {
    //check if the response has been received from the server
    if(http.readyState == 4){

        //read and assign the response from the server
        var response = http.responseText;

        //do additional parsing of the response, if needed

        //in this case simply assign the response to the contents of the <div> on the page.
        document.getElementById('city_weather').innerHTML = response;

        //If the server returned an error message like a 404 error, that message would be shown within the div tag!!.
        //So it may be worth doing some basic error before setting the contents of the <div>
    }
}