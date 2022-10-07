<?php

class City
{
    public $name;
    public $lat;
    public $lng;
    public $country;
    public $country_code;
    public $woeid;
    public $places_of_interest = array();
    public $weather;

    /**
     * City constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return array
     */

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getWoeid()
    {
        return $this->woeid;
    }

    /**
     * @param mixed $woeid
     */
    public function setWoeid($woeid)
    {
        $this->woeid = $woeid;
    }

    /**
     * @return array
     */
    public function getPlacesOfInterest()
    {
        return $this->places_of_interest;
    }
    /**
     * @param array $places_of_interest
     */
    public function setPlacesOfInterest($places_of_interest)
    {
        $this->places_of_interest = $places_of_interest;
    }

    /**
     * @return mixed
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @param mixed $weather
     */
    public function setWeather($weather)
    {
        $this->weather = $weather;
    }


}