<?php

namespace Staff\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="staff_department")
 * @ORM\Entity(repositoryClass="\Staff\Repository\Department")
 */
class Department
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $name;

    /**
     * MANY DIVISION may be part as ONE COMPANY
     * 
     * @ORM\ManyToOne(targetEntity="\Staff\Entity\Company", inversedBy="departments")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
     * */
    private $company;

    /**
     * MANY DIVISION may be have ONE parent DIVISION
     * 
     * @ORM\ManyToOne(targetEntity="\Staff\Entity\Department", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * ONE DIVISION may be have child MANY DIVISION
     * 
     * @ORM\OneToMany(targetEntity="\Staff\Entity\Department", mappedBy="parent")
     */
    private $children;

    /**
     * MANY POSITION may be have ONE DIVISION
     * 
     * @ORM\OneToMany(targetEntity="\Staff\Entity\Position", mappedBy="department")
     */
    private $positions;

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->children = new ArrayCollection();
	$this->positions = new ArrayCollection();
    }

    /**
     * Get department id
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
     * @param string $name
     * @return Department
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
     * Set company
     *
     * @param \Staff\Entity\Company $company
     * @return Department
     */
    public function setCompany(\Staff\Entity\Company $company)
    {
	$this->company = $company;

	return $this;
    }

    /**
     * Get company
     *
     * @return \Staff\Entity\Company 
     */
    public function getCompany()
    {
	return $this->company;
    }

    /**
     * Set parent
     *
     * @param \Staff\Entity\Department $parent
     * @return Department
     */
    public function setParent(\Staff\Entity\Department $parent = null)
    {
	$this->parent = $parent;

	return $this;
    }

    /**
     * Get parent
     *
     * @return \Staff\Entity\Department 
     */
    public function getParent()
    {
	return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Staff\Entity\Department $children
     * @return Department
     */
    public function addChild(\Staff\Entity\Department $children)
    {
	$this->children[] = $children;

	return $this;
    }

    /**
     * Remove children
     *
     * @param \Staff\Entity\Department $children
     */
    public function removeChild(\Staff\Entity\Department $children)
    {
	$this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
	return $this->children;
    }

    /**
     * Add positions
     *
     * @param \Staff\Entity\Position $positions
     * @return Department
     */
    public function addPosition(\Staff\Entity\Position $positions)
    {
	$this->positions[] = $positions;

	return $this;
    }

    /**
     * Remove positions
     *
     * @param \Staff\Entity\Position $positions
     */
    public function removePosition(\Staff\Entity\Position $positions)
    {
	$this->positions->removeElement($positions);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPositions()
    {
	return $this->positions;
    }

}
