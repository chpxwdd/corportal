<?php

namespace Lunch\Entity;

use Doctrine\ORM\Mapping as ORM;

//use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="lunch_order")
 * @ORM\Entity(repositoryClass="\Lunch\Repository\Order")
 */
class Order
{

    /**
     * 
     * @ORM\Id 
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $order;

    /**
     * Double sides - MANY orders maybe added by on ONE week (owner side)
     *
     * @ORM\ManyToOne(targetEntity="\Lunch\Entity\Week")
     * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
     */
    private $week;

    /**
     * Double sides - MANY orders maybe added by ONE user (owner side)
     *
     * @ORM\ManyToOne(targetEntity="\Dashboard\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Double sides - MANY orders maybe delivered in MANY offices (owner side)
     *
     * @ORM\ManyToOne(targetEntity="\Corporate\Entity\Office")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $office;
    
    /**
     * 
     * @ORM\Column(name="do_create", type="datetime", nullable=false)
     */
    private $doCreate;



    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set doCreate
     *
     * @param \DateTime $doCreate
     * @return Order
     */
    public function setDoCreate($doCreate)
    {
        $this->doCreate = $doCreate;

        return $this;
    }

    /**
     * Get doCreate
     *
     * @return \DateTime 
     */
    public function getDoCreate()
    {
        return $this->doCreate;
    }

    /**
     * Set week
     *
     * @param \Lunch\Entity\Week $week
     * @return Order
     */
    public function setWeek(\Lunch\Entity\Week $week = null)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return \Lunch\Entity\Week 
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set user
     *
     * @param \Dashboard\Entity\User $user
     * @return Order
     */
    public function setUser(\Dashboard\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dashboard\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set office
     *
     * @param \Staff\Entity\Office $office
     * @return Order
     */
    public function setOffice(\Staff\Entity\Office $office = null)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return \Staff\Entity\Office 
     */
    public function getOffice()
    {
        return $this->office;
    }
}
