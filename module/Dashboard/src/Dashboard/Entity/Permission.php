<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dashboard_permission")
 *
 * ORM\Entity(repositoryClass="\Dashboard\Repository\Permission")
 * @author Alex Chereanov <chpxwdd@gmail.com>
 */
class Permission
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="permission", type="string", length=255, nullable=false, unique=true)
     */
    private $permission;
    
    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="\Dashboard\Entity\Role", inversedBy="permissions")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="\Dashboard\Entity\Resource", inversedBy="permissions")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

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
     * Set permission
     *
     * @param string $permission
     * @return Permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Permission
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
     * Set role
     *
     * @param \Dashboard\Entity\Role $role
     * @return Permission
     */
    public function setRole(\Dashboard\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Dashboard\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set resource
     *
     * @param \Dashboard\Entity\Resource $resource
     * @return Permission
     */
    public function setResource(\Dashboard\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Dashboard\Entity\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }
}
