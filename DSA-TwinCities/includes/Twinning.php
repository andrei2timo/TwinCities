<?php


class Twinning
{
    private $desc;
    private $poi_join = array();
    private $banner;
    private $desc_source;

    /**
     * Twinning constructor.
     * @param $desc
     * @param $poi_join
     */
    public function __construct()
    {
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
    public function getPoiJoin()
    {
        return $this->poi_join;
    }

    /**
     * @param mixed $poi_join
     */
    public function setPoiJoin($poi_join)
    {
        $this->poi_join = $poi_join;
    }

    /**
     * @param $poi_join
     */
    public function addPoiJoin($poi_join)
    {
        array_push($this->poi_join,$poi_join);
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param mixed $banner
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return mixed
     */
    public function getDescSource()
    {
        return $this->desc_source;
    }

    /**
     * @param mixed $desc_source
     */
    public function setDescSource($desc_source)
    {
        $this->desc_source = $desc_source;
    }


}