<?php

namespace Staff\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="staff_position")
 * @ORM\Entity(repositoryClass="\Staff\Repository\Position")
 */
class Position
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $position;

    /**
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * MANY POSITION may be part as ONE DIVISION
     * 
     * @ORM\ManyToOne(targetEntity="\Staff\Entity\Department", inversedBy="positions")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id", nullable=false)
     * */
    private $department;

    /**
     * is taked position flag
     * 
     * @var int
     * 
     * @ORM\Column(name="is_taked", type="boolean")
     */
    private $isTaked;

    /**
     * is chief position flag
     *
     * @ORM\Column(name="is_chief", type="boolean")
     */
    private $isChief;

    /**
     * @ORM\ManyToOne(targetEntity="\Staff\Entity\Position", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="\Staff\Entity\Position", mappedBy="parent")
     */
    private $children;

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Position
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
     * Set isTaked
     *
     * @param boolean $isTaked
     * @return Position
     */
    public function setIsTaked($isTaked)
    {
        $this->isTaked = $isTaked;

        return $this;
    }

    /**
     * Get isTaked
     *
     * @return boolean 
     */
    public function getIsTaked()
    {
        return $this->isTaked;
    }

    /**
     * Set isChief
     *
     * @param boolean $isChief
     * @return Position
     */
    public function setIsChief($isChief)
    {
        $this->isChief = $isChief;

        return $this;
    }

    /**
     * Get isChief
     *
     * @return boolean 
     */
    public function getIsChief()
    {
        return $this->isChief;
    }

    /**
     * Set department
     *
     * @param \Staff\Entity\Department $department
     * @return Position
     */
    public function setDepartment(\Staff\Entity\Department $department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \Staff\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set parent
     *
     * @param \Staff\Entity\Position $parent
     * @return Position
     */
    public function setParent(\Staff\Entity\Position $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Staff\Entity\Position 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Staff\Entity\Position $children
     * @return Position
     */
    public function addChild(\Staff\Entity\Position $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Staff\Entity\Position $children
     */
    public function removeChild(\Staff\Entity\Position $children)
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
}
