<?php

namespace Geo\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="geo_country")
 * @ORM\Entity(repositoryClass="\Geo\Repository\Country")
 */
class Country {

    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title_ru", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_ru;

    /**
     * @ORM\Column(name="title_ua", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_ua;

    /**
     * @ORM\Column(name="title_be", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_be;

    /**
     * @ORM\Column(name="title_en", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_en;

    /**
     * @ORM\Column(name="title_es", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_es;

    /**
     * @ORM\Column(name="title_pt", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_pt;

    /**
     * @ORM\Column(name="title_de", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_de;

    /**
     * @ORM\Column(name="title_fr", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_fr;

    /**
     * @ORM\Column(name="title_it", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_it;

    /**
     * @ORM\Column(name="title_pl", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_pl;

    /**
     * @ORM\Column(name="title_ja", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_ja;

    /**
     * @ORM\Column(name="title_lt", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_lt;

    /**
     * @ORM\Column(name="title_lv", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_lv;

    /**
     * @ORM\Column(name="title_cz", type="string", length=60, nullable=false)
     * @var string
     */
    private $title_cz;

    /** @return string */
    public function getTitle_be() { return $this->title_be; }

    /** @return string */
    public function getTitle_cz() { return $this->title_cz; }

    /** @return string */
    public function getTitle_de() { return $this->title_de; }

    /** @return string */
    public function getTitle_en() { return $this->title_en; }

    /** @return string */
    public function getTitle_es() { return $this->title_es; }

    /** @return string */
    public function getTitle_fr() { return $this->title_fr; }

    /** @return string */
    public function getTitle_it() { return $this->title_it; }

    /** @return string */
    public function getTitle_ja() { return $this->title_ja; }

    /** @return string */
    public function getTitle_lt() { return $this->title_lt; }

    /** @return string */
    public function getTitle_lv() { return $this->title_lv; }

    /** @return string */
    public function getTitle_pt() { return $this->title_pt; }

    /** @return string */
    public function getTitle_pl() { return $this->title_pl; }

    /** @return string */
    public function getTitle_ru() { return $this->title_ru; }

    /** @return string */
    public function getTitle_ua() { return $this->title_ua; }
}
