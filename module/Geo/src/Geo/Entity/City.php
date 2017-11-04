<?php

namespace Geo\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="geo_city")
 * @ORM\Entity(repositoryClass="\Geo\Repository\City")
 */
class City {

    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Geo\Entity\Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country", referencedColumnName="id", nullable=true)
     * @var \Geo\Entity\Country
     */
    private $country;

    /**
     * 
     * @ORM\Column(name="important", type="boolean", nullable=true, options={"default" : FALSE}) 
     * @var bool
     */
    private $important;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Geo\Entity\Region", inversedBy="cities")
     * @ORM\JoinColumn(name="region", referencedColumnName="id", nullable=true)
     * @var \Geo\Entity\Region
     */
    private $region;

    /**
     * 
     * @ORM\Column(name="title_ru", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_ru;

    /**
     * 
     * @ORM\Column(name="area_ru", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_ru;

    /**
     * 
     * @ORM\Column(name="region_ru", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_ru;

    /**
     * 
     * @ORM\Column(name="title_ua", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_ua;

    /**
     * 
     * @ORM\Column(name="area_ua", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_ua;

    /**
     * 
     * @ORM\Column(name="region_ua", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_ua;

    /**
     * 
     * @ORM\Column(name="title_be", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_be;

    /**
     * 
     * @ORM\Column(name="area_be", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_be;

    /**
     * 
     * @ORM\Column(name="region_be", type="string", length=150, nullable=true, options={"default" : NULL})
     * @var string
     */
    private $region_be;

    /**
     * 
     * @ORM\Column(name="title_en", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_en;

    /**
     * 
     * @ORM\Column(name="area_en", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_en;

    /**
     * 
     * @ORM\Column(name="region_en", type="string", length=150, nullable=true, options={"default" : NULL})
     * @var string
     */
    private $region_en;

    /**
     * 
     * @ORM\Column(name="title_es", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_es;

    /**
     * 
     * @ORM\Column(name="area_es", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_es;

    /**
     * 
     * @ORM\Column(name="region_es", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_es;

    /**
     * 
     * @ORM\Column(name="title_pt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_pt;

    /**
     * 
     * @ORM\Column(name="area_pt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_pt;

    /**
     * 
     * @ORM\Column(name="region_pt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_pt;

    /**
     * 
     * @ORM\Column(name="title_de", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_de;

    /**
     * 
     * @ORM\Column(name="area_de", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_de;

    /** @ORM\Column(name="region_de", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_de;

    /**
     * 
     * @ORM\Column(name="title_fr", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_fr;

    /**
     * 
     * @ORM\Column(name="area_fr", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_fr;

    /**
     * 
     * @ORM\Column(name="region_fr", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_fr;

    /**
     * 
     * @ORM\Column(name="title_it", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_it;

    /**
     * 
     * @ORM\Column(name="area_it", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_it;

    /**
     * 
     * @ORM\Column(name="region_it", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_it;

    /**
     * 
     * @ORM\Column(name="title_pl", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_pl;

    /**
     * 
     * @ORM\Column(name="area_pl", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_pl;

    /**
     * 
     * @ORM\Column(name="region_pl", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_pl;

    /**
     * 
     * @ORM\Column(name="title_ja", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_ja;

    /**
     * 
     * @ORM\Column(name="area_ja", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_ja;

    /**
     * 
     * @ORM\Column(name="region_ja", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_ja;

    /**
     * 
     * @ORM\Column(name="title_lt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_lt;

    /**
     * 
     * @ORM\Column(name="area_lt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_lt;

    /**
     * 
     * @ORM\Column(name="region_lt", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_lt;

    /**
     * 
     * @ORM\Column(name="title_lv", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_lv;

    /**
     * 
     * @ORM\Column(name="area_lv", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_lv;

    /**
     * 
     * @ORM\Column(name="region_lv", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_lv;

    /**
     * 
     * @ORM\Column(name="title_cz", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $title_cz;

    /**
     * 
     * @ORM\Column(name="area_cz", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $area_cz;

    /**
     * 
     * @ORM\Column(name="region_cz", type="string", length=150, nullable=true, options={"default" : NULL}) 
     * @var string
     */
    private $region_cz;

    public function __construct() {
	$props = get_object_vars($this);
	foreach (array_keys($props) as $name) {
	    print <<<HEREDOC

    public function setRegio_$name(|code, |value) {
	|this->$name = |value;
	return |this;
    }
		
    public function getRegion(|code) {
	return |this->$name;
    }
		
HEREDOC;
	}
	die();
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function setRegion($code, $value) {
	$this->{"region_$code"} = $value;
	return $this;
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function getRegion($code) {
	return $this->{"region_$code"};
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function setArea($code, $value) {
	$this->{"area_$code"} = $value;
	return $this;
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function getArea($code) {
	return $this->{"area_$code"};
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function setTitle($code, $value) {
	$this->{"title_$code"} = $value;
	return $this;
    }

    /**
     * 
     * @param string $code
     * @param string $value
     * @return City
     */
    public function getTitle($code) {
	return $this->{"title_$code"};
    }

}
