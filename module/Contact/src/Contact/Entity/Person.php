<?php

namespace Contact\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_person")
 * @ORM\Entity(repositoryClass="\Contact\Repository\Person")
 */
class Person {

    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Contact first name
     * 
     * @ORM\Column(name="fname", type="string", nullable=false)
     * @var string
     */
    private $fname;

    /**
     * Contact middle name
     * 
     * @ORM\Column(name="mname", type="string", nullable=true)
     * @var string
     */
    private $mname;

    /**
     * Contact surname
     * 
     * @ORM\Column(name="sname", type="string", nullable=false)
     * @var string
     */
    private $sname;

    /**
     * Contact birth date
     * 
     * @ORM\Column(name="do_birth", type="datetime", nullable=true)
     * @var string
     */
    private $birth;

    /**
     * Contact gender 'f' - female, 'm' - male
     * 
     * @ORM\Column(name="gender", type="string", length=1, nullable=false)
     * @var string
     */
    private $gender;

    /**
     * Constructor
     */
    public function __construct() {
	$this->phones = new ArrayCollection();
	$this->emails = new ArrayCollection();
	$this->adreses = new ArrayCollection();
    }

    /**
     * Get the object to an array.
     *
     * @return array
     */
    public function getFullname() {
	return $this->sname . ' ' . $this->fname . ' ' . $this->mname;
    }

    /**
     * Get the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
	return get_object_vars($this);
    }

    /**
     * binding data.
     *
     * @return array
     */
    public function setData($data = array()) {
	
//	print "<pre>";var_dump($data);print "</pre>";
	$this->setSname($data["sname"]);
	$this->setFname($data["fname"]);
	$this->setMname($data["mname"]);
	$this->setBirth($data["birth"]);
	$this->setGender($data["gender"]);

	return $this;

//	$this->setPhones($data->phones);
//	$this->setEmails($data->emails);
//	$this->setAdresses($data->adresses);
    }

    /**
     * Get contact
     *
     * @return integer 
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Set fname
     *
     * @param string $fname
     * @return Person
     */
    public function setFname($fname) {
	$this->fname = $fname;

	return $this;
    }

    /**
     * Get fname
     *
     * @return string 
     */
    public function getFname() {
	return $this->fname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     * @return Person
     */
    public function setMname($mname) {
	$this->mname = $mname;

	return $this;
    }

    /**
     * Get mname
     *
     * @return string 
     */
    public function getMname() {
	return $this->mname;
    }

    /**
     * Set sname
     *
     * @param string $sname
     * @return Person
     */
    public function setSname($sname) {
	$this->sname = $sname;

	return $this;
    }

    /**
     * Get sname
     *
     * @return string 
     */
    public function getSname() {
	return $this->sname;
    }

    /**
     * Set birth
     *
     * @param \DateTime $birth
     * @return Person
     */
    public function setBirth($birth) {
	$this->birth = new \DateTime($birth);

	return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth() {
	return $this->birth;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Person
     */
    public function setGender($gender) {
	$this->gender = $gender;

	return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender() {
	return $this->gender;
    }

    /**
     * Add phone
     *
     * @param \Contact\Entity\Phone $phone
     * @return Contact
     */
    public function addPhone(\Contact\Entity\Phone $phone) {
	array_push($this->phones, $phone);

	return $this;
    }

    /**
     * Remove users
     *
     * @param \Contact\Entity\Phone $phone
     */
    public function removePhone(\Contact\Entity\Phone $phone) {
	$this->phones->removeElement($phone);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones() {
	return $this->phones;
    }

    /**
     * Add phone
     *
     * @param \Contact\Entity\Email $email
     * @return Person
     */
    public function addEmail(\Contact\Entity\Email $email) {
	array_push($this->emails, $email);

	return $this;
    }

    /**
     * Remove users
     *
     * @param \Contact\Entity\Email $email
     */
    public function removeEmail(\Contact\Entity\Email $email) {
	$this->emails->removeElement($email);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails() {
	return $this->emails;
    }

    /**
     * Add phone
     *
     * @param \Contact\Entity\Adress $adress
     * @return Person
     */
    public function addAdress(\Contact\Entity\Adress $adress) {
	array_push($this->adresses, $adress);

	return $this;
    }

    /**
     * Remove users
     *
     * @param \Contact\Entity\Adress $adress
     */
    public function removeAdress(\Contact\Entity\Adress $adress) {
	$this->adresses->removeElement($adress);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses() {
	return $this->adresses;
    }

    /**
     * 
     * @param array $adresses
     * @return Person
     */
    public function setAdresses(array $adresses) {
	return $this->adresses;
    }

}
