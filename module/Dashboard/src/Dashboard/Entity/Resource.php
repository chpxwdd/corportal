<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="dashboard_resource")
 *
 * ORM\Entity(repositoryClass="\Dashboard\Repository\Resource")
 * 
 * @author Alex Chereanov <chpxwdd@gmail.com>
 */
class Resource {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="resource", type="string", length=255, nullable=false, unique=true)
     */
    private $resource;

    /**
     * @ORM\Column(name="descriptionription", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="\Dashboard\Entity\Resource", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="\Dashboard\Entity\Resource", mappedBy="parent")
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="\Dashboard\Entity\Permission", mappedBy="resource")
     */
    private $permissions;

    /**
     * Constructor
     */
    public function __construct() {
	$this->children = new ArrayCollection();
	$this->permissions = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Set resource
     *
     * @param string $resource
     * @return Resource
     */
    public function setResource($resource) {
	$this->resource = $resource;

	return $this;
    }

    /**
     * Get resource
     *
     * @return string 
     */
    public function getResource() {
	return $this->resource;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Resource
     */
    public function setDescription($description) {
	$this->description = $description;

	return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
	return $this->description;
    }

    /**
     * Set parent
     *
     * @param \Dashboard\Entity\Resource $parent
     * @return Resource
     */
    public function setParent(\Dashboard\Entity\Resource $parent = null) {
	$this->parent = $parent;

	return $this;
    }

    /**
     * Get parent
     *
     * @return \Dashboard\Entity\Resource 
     */
    public function getParent() {
	return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Dashboard\Entity\Resource $children
     * @return Resource
     */
    public function addChild(\Dashboard\Entity\Resource $children) {
	array_push($this->children, $children);

	return $this;
    }

    /**
     * Remove children
     *
     * @param \Dashboard\Entity\Resource $children
     */
    public function removeChild(\Dashboard\Entity\Resource $children) {
	$this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Collection 
     */
    public function getChildren() {
	return $this->children;
    }

}
