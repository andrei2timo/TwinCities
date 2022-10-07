<?php


class Weather
{
    private $temperature;
    private $humidity;
    private $wind_speed;
    private $wind_direction;
    private $icon;
    private $desc;
    private $weather_time;
    private $weather_saved;
    private $forecast;

    /**
     * Weather constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param mixed $humidity
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    /**
     * @return mixed
     */
    public function getWindSpeed()
    {
        return $this->wind_speed;
    }

    /**
     * @param mixed $wind_speed
     */
    public function setWindSpeed($wind_speed)
    {
        $this->wind_speed = $wind_speed;
    }

    /**
     * @return mixed
     */
    public function getWindDirection()
    {
        return $this->wind_direction;
    }

    /**
     * @param mixed $wind_direction
     */
    public function setWindDirection($wind_direction)
    {
        $this->wind_direction = $wind_direction;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getWeatherTime()
    {
        return $this->weather_time;
    }

    /**
     * @param mixed $weather_time
     */
    public function setWeatherTime($weather_time)
    {
        $this->weather_time = $weather_time;
    }

    /**
     * @return mixed
     */
    public function getWeatherSaved()
    {
        return $this->weather_saved;
    }

    /**
     * @param mixed $weather_saved
     */
    public function setWeatherSaved($weather_saved)
    {
        $this->weather_saved = $weather_saved;
    }

    /**
     * @return mixed
     */
    public function getForecast()
    {
        return $this->forecast;
    }

    /**
     * @param mixed $forecast
     */
    public function setForecast($forecast)
    {
        $this->forecast = $forecast;
    }


}