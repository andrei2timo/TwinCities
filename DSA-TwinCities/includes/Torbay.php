<!DOCTYPE html>
<html>
<head>

<style>
	body {
		background-image: url('../lights3.jpg');
}
h2 {
	text-align: center;
	position: absolute;
	left: 620px;
	top: 140px;
	}
	

</style>
</head>
	<h2 style = "font-family:georgia,garamond,serif;font-size:36px;color:white">Weather in Torbay</h2>
<body>

</body>
</html>
<?php

$title = 'Weather';
$currentPage = 'weather';
include_once __DIR__ . "/config.php";
require_once $base_path . '/templates/head.php';
require_once $base_path . '/templates/header.php';
require_once $base_path . '/templates/top_nav_bar.php';
require_once $base_path . '/templates/page_content.php';

// test url: http://api.openweathermap.org/data/2.5/weather?q=Portsmouth,GBR&APPID=241a91936b2c0cb420b6f98fdb7dd5f1
//City and country is provided in the URI (done by javascript/Ajax)
$_GET['city'] = 'Torbay';
$_GET['country'] = 'GBR';
if (isset($_GET['city']) && isset($_GET['country']) && $_GET['city'] == $city1->getName() && $_GET['country'] == $city1->getCountryCode())
{ //City is city 1
    $city = $city1;
}
elseif (isset($_GET['city']) && isset($_GET['country']) && $_GET['city'] == $city2->getName() && $_GET['country'] == $city2->getCountryCode())
{ //City is city 2
    $city = $city2;
}
else
{
    echo("<p>Weather cannot be fetched at the moment</p>");
    die();
}


//Load weather from data
try {

    $data = simplexml_load_file($base_path.'/data/cities.xml');
    $xpath_city_weather = $data->xpath("/twinning/cities/city[@woeid='".$city->getWoeid()."']/weather");
    $result = simplexml_load_string($xpath_city_weather[0]->asXML());

    //Read current weather
    $temp_weather = new Weather();
    $temp_weather->setTemperature($result->current_weather->temperature);
    $temp_weather->setHumidity($result->current_weather->humidity);
    $temp_weather->setWindSpeed($result->current_weather->wind_speed);
    $temp_weather->setWindDirection($result->current_weather->wind_direction);
    $temp_weather->setIcon($result->current_weather->icon);
    $temp_weather->setDesc($result->current_weather->description);
    $temp_weather->setWeatherTime($result->current_weather->weather_time);
    $temp_weather->setWeatherSaved($result->current_weather->weather_saved);

    //Find forecast
    $temp_forecast = new Weather();
    $temp_forecast->setTemperature($result->forecast_weather->temperature);
    $temp_forecast->setHumidity($result->forecast_weather->humidity);
    $temp_forecast->setWindSpeed($result->forecast_weather->wind_speed);
    $temp_forecast->setWindDirection($result->forecast_weather->wind_direction);
    $temp_forecast->setIcon($result->forecast_weather->icon);
    $temp_forecast->setDesc($result->forecast_weather->description);
    $temp_forecast->setWeatherTime($result->forecast_weather->weather_time);
    $temp_forecast->setWeatherSaved($result->forecast_weather->weather_saved);


    //Save weather to objects
    $temp_weather->setForecast($temp_forecast);
    $city->setWeather($temp_weather);

} catch (Exception $e)
{
    echo "Connnecton failed: " . $e->getMessage();
    die();
}


//Check database for weather (update every hour)
if ((time() - (60*60) <= (int) $city->getWeather()->getWeatherSaved()) && time() < $city->getWeather()->getForecast()->getWeatherTime())
{ //Data is recent
    $current_weather = $city->getWeather();
    $forecast_weather = $current_weather->getForecast();

    echo(displayCurrentAndForecast($current_weather,$forecast_weather));
}
else
{ //Data is old

    //Current weather
    $current_weather_url = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city->getName().",".$city->getCountryCode()."&APPID=".$open_weather_key));
    $current_weather = new Weather();
    if (isset($current_weather_url->main->temp))
    {
        $current_weather->setTemperature($current_weather_url->main->temp);
    }
    else
    {
        $current_weather->setTemperature(-400);
    }
    if (isset($current_weather_url->main->humidity))
    {
        $current_weather->setHumidity($current_weather_url->main->humidity);
    }
    else
    {
        $current_weather->setHumidity(-10);
    }
    if (isset($current_weather_url->wind->deg))
    {
        $current_weather->setWindDirection($current_weather_url->wind->deg);
    }
    else
    {
        $current_weather->setWindDirection(-10);
    }
    if (isset($current_weather_url->wind->speed))
    {
        $current_weather->setWindSpeed($current_weather_url->wind->speed);
    }
    else
    {
        $current_weather->setWindSpeed(-10);
    }
    if (isset($current_weather_url->weather[0]->icon))
    {
        $current_weather->setIcon($current_weather_url->weather[0]->icon);
    }
    else
    {
        $current_weather->setIcon("03d.png");
    }
    if (isset($current_weather_url->weather[0]->description))
    {
        $current_weather->setDesc($current_weather_url->weather[0]->description);
    }
    else
    {
        $current_weather->setDesc("Cannot establish connection");
    }
    $current_weather->setWeatherTime($current_weather_url->dt);
    $current_weather->setWeatherSaved(time());

    //Forecast weather
    $forecast_weather_url = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/forecast?q=".$city->getName().",".$city->getCountryCode()."&APPID=".$open_weather_key));
    $forecast_weather = new Weather();
    $forecast_id = $forecast_weather_url->list[0];
    if (isset($forecast_id->main->temp))
    {
        $forecast_weather->setTemperature($forecast_id->main->temp);
    }
    else
    {
        $forecast_weather->setTemperature(-400);
    }
    if (isset($forecast_id->main->humidity))
    {
        $forecast_weather->setHumidity($forecast_id->main->humidity);
    }
    else
    {
        $forecast_weather->setHumidity(-10);
    }
    if (isset($forecast_id->wind->deg))
    {
        $forecast_weather->setWindDirection($forecast_id->wind->deg);
    }
    else
    {
        $forecast_weather->setWindDirection(-10);
    }
    if (isset($forecast_id->wind->speed))
    {
        $forecast_weather->setWindSpeed($forecast_id->wind->speed);
    }
    else
    {
        $forecast_weather->setWindSpeed(-10);
    }
    if (isset($forecast_id->weather[0]->icon))
    {
        $forecast_weather->setIcon($forecast_id->weather[0]->icon);
    }
    else
    {
        echo("idjffd");
        $forecast_weather->setIcon("50d.png");
    }
    if (isset($forecast_id->weather[0]->description))
    {
        $forecast_weather->setDesc($forecast_id->weather[0]->description);
    }
    else
    {
        $current_weather->setDesc("Cannot establish connection");
    }
    $forecast_weather->setWeatherTime($forecast_id->dt);
    $forecast_weather->setWeatherSaved(time());

    $current_weather->setForecast($forecast_weather);


    //Save to city
    $city->setWeather($current_weather);


    //Display weather
    echo(displayCurrentAndForecast($city->getWeather(),$city->getWeather()->getForecast()));

    //Save the data
    try {

        //Update data
        $data = simplexml_load_file($base_path.'/data/cities.xml');

        //Loop but woeid is unique for a city so only happens once
        foreach ($data->xpath("/twinning/cities/city[@woeid='".$city->getWoeid()."']") as $t)
        {
            //Current weather
            $t->weather->current_weather->temperature = $current_weather->getTemperature();
            $t->weather->current_weather->humidity = $current_weather->getHumidity();
            $t->weather->current_weather->wind_speed = $current_weather->getWindSpeed();
            $t->weather->current_weather->wind_direction = $current_weather->getWindDirection();
            $t->weather->current_weather->icon = $current_weather->getIcon();
            $t->weather->current_weather->description = $current_weather->getDesc();
            $t->weather->current_weather->weather_time = $current_weather->getWeatherTime();
            $t->weather->current_weather->weather_saved = $current_weather->getWeatherSaved();

            //Forecast weather
            $t->weather->forecast_weather->temperature = $forecast_weather->getTemperature();
            $t->weather->forecast_weather->humidity = $forecast_weather->getHumidity();
            $t->weather->forecast_weather->wind_speed = $forecast_weather->getWindSpeed();
            $t->weather->forecast_weather->wind_direction = $forecast_weather->getWindDirection();
            $t->weather->forecast_weather->icon = $forecast_weather->getIcon();
            $t->weather->forecast_weather->description = $forecast_weather->getDesc();
            $t->weather->forecast_weather->weather_time = $forecast_weather->getWeatherTime();
            $t->weather->forecast_weather->weather_saved = $forecast_weather->getWeatherSaved();
        }

        $data->asXML($base_path."/data/cities.xml");

    }
    catch (Exception $e)
    {
        echo "Connnecton failed: " . $e->getMessage();
        die();
    }
}

function degreeCompassPointConv($d)
{ //From worksheet 4,
    $dp = $d + 11.25;
    $dp = $dp % 360;
    $dp = floor($dp / 22.5) ;
    $points = array("N","NNE","NE","ENE","E","ESE","SE" ,"SSE" ,"S", "SSW","SW","WSW","W", "WNW","NW","NNW","N");
    $dir = $points[$dp];
    return $dir;
};

function displayCurrentAndForecast($current,$forecast)
{
    if ($current->getIcon()[2] == "n")
    { // Night
        $current_time = "night";
    }
    else
    {
        $current_time = "day";
    }

    if ($forecast->getIcon()[2] == "n")
    { // Night
        $forecast_time = "night";
    }
    else
    {
        $forecast_time = "day";
    }
    $output = '<table class="table_weather"><th colspan="3">Last cached: '.gmdate("Y-m-d H:i T",date((int)$current->getWeatherSaved())).' [Hourly]</th><tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Time</td>';
    $output .= '<td>Current</td>';
    $output .= '<td>'.gmdate("d-m-Y H:i T",date((int)$forecast->getWeatherTime())).'</td>';
    $output .= '</tr>';
    $output .= '<tr>';
        $output .= '<td id="w_type">Visual</td>';
        $output .= '<td id="'.$current_time.'"><img src="http://openweathermap.org/img/w/'.$current->getIcon().'.png"></td>';
        $output .= '<td id="'.$forecast_time.'"><img src="http://openweathermap.org/img/w/'.$forecast->getIcon().'.png"></td>';
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Day/Night</td>';
    if ($current_time == "night")
    {
        $output .= '<td>Night</td>';
    }
    else
    {
        $output .= '<td>Day</td>';
    }
    if ($forecast_time == "night")
    {
        $output .= '<td>Night</td>';
    }
    else
    {
        $output .= '<td>Day</td>';
    }
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Description</td>';
    $output .= '<td>'.$current->getDesc().'</td>';
    $output .= '<td>'.$forecast->getDesc().'</td>';
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Temperature</td>';
    $output .= '<td>'.($current->getTemperature() != -400 ? round(($current->getTemperature()) - 273.15,1).'°C' : '').'</td>';
    $output .= '<td>'.round(($forecast->getTemperature()) - 273.15,1).'°C</td>';
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Humidity</td>';
    $output .= '<td>'.($current->getHumidity() != -10 ? $current->getHumidity().'%' : 'N/A').'</td>';
    $output .= '<td>'.$forecast->getHumidity().'%</td>';
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Wind Speed</td>';
    $output .= '<td>'.($current->getWindSpeed() != -10 ? $current->getWindSpeed().' m/s' : 'N/A').'</td>';
    $output .= '<td>'.$forecast->getWindSpeed().' m/s</td>';
    $output .= '</tr>';
    $output .= '<tr>';
    $output .= '<td id="w_type">Wind Direction</td>';
    $output .= '<td>'.($current->getWindDirection() != -10 ? degreeCompassPointConv($current->getWindDirection()).' ('.$current->getWindDirection().'°)' : 'N/A').'</td>';
    $output .= '<td>'.degreeCompassPointConv($forecast->getWindDirection()).' ('.$forecast->getWindDirection().'°)</td>';
    $output .= '</tr></table>';

    return $output;
}
?>

