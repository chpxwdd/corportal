<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="dashboard_role")
 * @ORM\Entity(repositoryClass="\Dashboard\Repository\Role")
 *
 * @author Alex Chereanov <chpxwdd@gmail.com>
 */
class Role
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="role", type="string", nullable=false, unique=true)
     * @var string
     */
    private $role;

    /**
     * Permission collection
     * 
     * @ORM\OneToMany(targetEntity="\Dashboard\Entity\Permission", mappedBy="role")
     * @var \Doctrine\Common\Collections\Collection
     */
    private $permissions;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Dashboard\Entity\Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * @var \Dashboard\Entity\Role
     */
    private $parent;

    /**
     * Children roles collection
     * 
     * @ORM\OneToMany(targetEntity="\Dashboard\Entity\Role", mappedBy="parent")
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->children = new ArrayCollection();
	$this->permissions = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
	$this->role = $role;

	return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
	return $this->role;
    }

    /**
     * Set parent
     *
     * @param \Dashboard\Entity\Role $parent
     * @return Role
     */
    public function setParent(\Dashboard\Entity\Role $parent = null)
    {
	$this->parent = $parent;

	return $this;
    }

    /**
     * Get parent id
     *
     * @return \Dashboard\Entity\Role 
     */
    public function getParent()
    {
	return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Dashboard\Entity\Role $children
     * @return Role
     */
    public function addChild(\Dashboard\Entity\Role $children)
    {
	$this->children[] = $children;

	return $this;
    }

    /**
     * Remove children
     *
     * @param \Dashboard\Entity\Role $children
     */
    public function removeChild(\Dashboard\Entity\Role $children)
    {
	$this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Collection 
     */
    public function getChildren()
    {
	return $this->children;
    }

}
