<?php

namespace Contact\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_adress")
 * @ORM\Entity(repositoryClass="\Contact\Repository\Adress")
 */
class Adress {

    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Number
     * 
     * @ORM\Column(name="number", type="string", nullable=false)
     * @var string
     */
    private $adress;
//
//    /**
//     * ONE EMPLOYEE may be worked on ONE COMPANY
//     * 
//     * @ORM\OneToOne(targetEntity="\Contact\Entity\Country")
//     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
//     */
//    private $country;
    
    
    /**
     * State
     * 
     * @ORM\Column(name="state", type="integer", nullable=true)
     * @var int
     */
    private $state;

    /**
     * Adress type 'home|mobile
     * 
     * @ORM\Column(name="main", type="integer", nullable=true)
     * @var string
     */
    private $isMain;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Contact\Entity\Person", inversedBy="adresses")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=true)
     * @var \Contact\Entity\Person
     */
    private $person;

    /**
     * Constructor
     */
    public function __construct() {
	
    }
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
	return $this->id;
    }
    

    /**  @return int */
    public function getNumber() {
	return $this->number;
    }

    /**
     * 
     * @param int $number
     * @return \Contact\Entity\Adress
     */
    public function setNumber($number) {
	$this->number = $number;
	return $this;
    }

    /**  @return string  */
    public function getType() {
	return $this->type;
    }

    /**
     * 
     * @param int $number
     * @return \Contact\Entity\Adress
     */
    public function setType($type) {
	$this->type = $type;
	return $this;
    }

    /**  @return int    */
    public function getExtention() {
	return $this->extention;
    }

    /**
     * 
     * @param int $extention
     * @return \Contact\Entity\Adress
     */
    public function setExtetion($extention) {
	$this->extention = $extention;
	return $this;
    }

    /**
     * 
     * @param \Contact\Entity\Person $person
     * @return \Contact\Entity\Adress
     */
    public function setPerson(\Contact\Entity\Person $person) {
	$this->person = $person;
	return $this;
    }

    /**  @return \Contact\Entity\Person $person    */
    public function getPerson() {
	return $this->person;
    }

    public function setData($data) {
	$this->number = $data->number;
	$this->extention = $data->extention;
	$this->type = $data->type;
	$this->person = $data->person;
    }
    
}
