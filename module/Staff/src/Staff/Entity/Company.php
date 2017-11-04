<?php

namespace Staff\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="staff_company")
 * @ORM\Entity(repositoryClass="\Staff\Repository\Company")
 */
class Company
{

    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * 
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * 
     * @ORM\OneToMany(targetEntity="\Staff\Entity\Department", mappedBy="company")
     */
    private $departments;

    /**
     * constructor
     */
    public function __construct()
    {
	$this->departments = new ArrayCollection();
    }

    /**
     * Get company
     *
     * @return integer 
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * Set name
     *
     * @param string $description
     * @return Company
     */
    public function setDescription($description)
    {
	$this->description = $description;

	return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
	return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Company
     */
    public function setName($name)
    {
	$this->name = $name;

	return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
	return $this->name;
    }

    /**
     * Add departments
     *
     * @param \Staff\Entity\Department $departments
     * @return Company
     */
    public function addDepartment(\Staff\Entity\Department $departments)
    {
	$this->departments[] = $departments;

	return $this;
    }

    /**
     * Remove departments
     *
     * @param \Staff\Entity\Department $departments
     */
    public function removeDepartment(\Staff\Entity\Department $departments)
    {
	$this->departments->removeElement($departments);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartments()
    {
	return $this->departments;
    }

}
