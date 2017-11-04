<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="dashboard_session")
 * @ORM\Entity(repositoryClass="\Dashboard\Repository\Session")
 *
 * @author Alex Chereanov <chpxwdd@gmail.com>
 */
class Session
{

    /**
     * Session variable id
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=32, name="id")
     * @var int
     */
    protected $id;

    /**
     * Session variable name
     * 
     * @ORM\Column(type="string", length=32, nullable=false, name="name")
     * @var string
     */
    protected $name;

    /**
     * Session modifyed timestamp
     * 
     * @ORM\Column(type="integer", nullable=false, name="modified")
     * @var int
     */
    protected $modified;

    /**
     * Session lifetime count seconds
     * 
     * @ORM\Column(type="integer", nullable=false, name="lifetime")
     * @var int
     */
    protected $lifetime;

    /**
     * Session data
     * 
     * @ORM\Column(type="text", nullable=false, name="data")
     * @var string
     */
    protected $data;

    /**
     * Set id
     *
     * @param string $id
     * @return Session
     */
    public function setId($id)
    {
	$this->id = $id;

	return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Session
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
     * Set modified
     *
     * @param integer $modified
     * @return Session
     */
    public function setModified($modified)
    {
	$this->modified = $modified;

	return $this;
    }

    /**
     * Get modified
     *
     * @return integer 
     */
    public function getModified()
    {
	return $this->modified;
    }

    /**
     * Set lifetime
     *
     * @param integer $lifetime
     * @return Session
     */
    public function setLifetime($lifetime)
    {
	$this->lifetime = $lifetime;

	return $this;
    }

    /**
     * Get lifetime
     *
     * @return integer 
     */
    public function getLifetime()
    {
	return $this->lifetime;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Session
     */
    public function setData($data)
    {
	$this->data = $data;

	return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
	return $this->data;
    }

}
