<?php

namespace Contact\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_phone")
 * @ORM\Entity(repositoryClass="\Contact\Repository\Phone")
 */
class Phone {

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
    private $number;

    /**
     * Extention
     * 
     * @ORM\Column(name="extention", type="integer", nullable=true)
     * @var int
     */
    private $extention;

    /**
     * Phone type 'home|mobile
     * 
     * @ORM\Column(name="type", type="string", length=16, nullable=false)
     * @var string
     */
    private $type;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Contact\Entity\Person", inversedBy="phones")
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
     * @return \Contact\Entity\Phone
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
     * @return \Contact\Entity\Phone
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
     * @return \Contact\Entity\Phone
     */
    public function setExtetion($extention) {
	$this->extention = $extention;
	return $this;
    }

    /**
     * 
     * @param \Contact\Entity\Person $person
     * @return \Contact\Entity\Phone
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
