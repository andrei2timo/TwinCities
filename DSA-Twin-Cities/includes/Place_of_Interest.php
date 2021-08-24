<?php

class Place_of_Interest
{
    private $name;
    private $category;

    /**
     * Place_of_Interest constructor.
     * @param $name
     * @param $category
     */
    public function __construct($name, $category)
    {
        $this->name = $name;
        $this->category = $category;
    }

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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }




}