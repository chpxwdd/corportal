<?php

namespace Currency\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="currency_lib")
 * @ORM\Entity(repositoryClass="\Currency\Repository\Library")
 */
class Library
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int 
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=3, name="abbr")
     */
    private $abbr;

    /**
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;


    /**
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $state;

    /**
     * 
     * @ORM\Column(type="string", length=16, name="exrt_id", nullable=true)
     */
    private $code;
    
    /**
     * 
     * @return int
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getCode()
    {
	return $this->code;
    }

    /**
     * 
     * @return string
     */
    public function setCode($code)
    {
	$this->code = $code;
    }

    /**
     * 
     * @return string
     */
    public function getTitle()
    {
	return $this->title;
    }

    /**
     * 
     * @return string
     */
    public function setTitle($title)
    {
	$this->title = $title;
    }

    /**
     * 
     * @return string
     */
    public function getAbbr()
    {
	return $this->abbr;
    }

    /**
     * 
     * @return string
     */
    public function setAbbr($abbr)
    {
	$this->abbr = $abbr;
    }

    /**
     * 
     * @return int
     */
    public function getState()
    {
	return $this->state;
    }

    /**
     * 
     * @return int
     */
    public function setState($state)
    {
	$this->state = $state;
    }

}
