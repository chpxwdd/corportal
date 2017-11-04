<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="dashboard_user")
 * ORM\Entity(repositoryClass="\Dashboard\Repository\User")
 *
 * @author Alex Chereanov <chpxwdd@gmail.com>
 */
class User
{

    /**
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * 
     * @ORM\Column(name="username", type="string", length=32, nullable=false)
     * @var string
     */
    protected $username;

    /**
     *
     * @ORM\Column(name="do_created", type="datetime", nullable=false)
     * @var string
     */
    protected $doCreated;

    /**
     * @ORM\Column(name="do_lastauth",type="datetime", nullable=true)
     * @var string
     */
    protected $doLastAuth;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="\Dashboard\Entity\Role")
     * @ORM\JoinTable(name="dashboard_linker_role_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")})
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->roles = new ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
	$this->username = $username;

	return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
	return $this->username;
    }

    /**
     * Set doCreated
     *
     * @param \DateTime $doCreated
     * @return User
     */
    public function setDoCreated($doCreated)
    {
	$this->doCreated = $doCreated;

	return $this;
    }

    /**
     * Get doCreated
     *
     * @return \DateTime 
     */
    public function getDoCreated()
    {
	return $this->doCreated;
    }

    /**
     * Set doLastAuth
     *
     * @param \DateTime $doLastAuth
     * @return User
     */
    public function setDoLastAuth($doLastAuth)
    {
	$this->doLastAuth = $doLastAuth;

	return $this;
    }

    /**
     * Get doLastAuth
     *
     * @return \DateTime 
     */
    public function getDoLastAuth()
    {
	return $this->doLastAuth;
    }

    /**
     * Add roles
     *
     * @param \Dashboard\Entity\Role $roles
     * @return User
     */
    public function addRole(\Dashboard\Entity\Role $roles)
    {
	$this->roles[] = $roles;

	return $this;
    }

    /**
     * Remove roles
     *
     * @param \Dashboard\Entity\Role $roles
     */
    public function removeRole(\Dashboard\Entity\Role $roles)
    {
	$this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
	return $this->roles;
    }

}
