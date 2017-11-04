<?php

namespace Lunch\Entity;

use Doctrine\ORM\Mapping as ORM;

//use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="lunch_week")
 * @ORM\Entity(repositoryClass="\Lunch\Repository\Week")
 */
class Week
{

    /**
     * 
     * @ORM\Id 
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $week;

    /**
     * 
     * @ORM\Column(name="do_start", type="datetime", nullable=false)
     */
    private $doStart;

    /**
     * 
     * @ORM\Column(name="days", type="integer", nullable=false)
     */
    private $cntDays;

    /**
     * 
     * @ORM\Column(name="dotation", type="decimal", precision=10, scale=2)
     */
    private $dotation;

    /**
     * 
     * @ORM\Column(name="is_closed", type="boolean", nullable=false, options={"default" = 0})
     */
    private $isClosed;

    /**
     * 
     * @ORM\Column(name="do_publish", type="datetime", nullable=false)
     */
    private $doPublish;

    /**
     * Get week
     *
     * @return integer 
     */
    public function getWeek()
    {
	return $this->week;
    }

    /**
     * Set doStart
     *
     * @param \DateTime $doStart
     * @return Week
     */
    public function setDoStart($doStart)
    {
	$this->doStart = $doStart;

	return $this;
    }

    /**
     * Get doStart
     *
     * @return \DateTime 
     */
    public function getDoStart()
    {
	return $this->doStart;
    }

    /**
     * Set cntDays
     *
     * @param integer $cntDays
     * @return Week
     */
    public function setCntDays($cntDays)
    {
	$this->cntDays = $cntDays;

	return $this;
    }

    /**
     * Get cntDays
     *
     * @return integer 
     */
    public function getCntDays()
    {
	return $this->cntDays;
    }

    /**
     * Set dotation
     *
     * @param string $dotation
     * @return Week
     */
    public function setDotation($dotation)
    {
	$this->dotation = $dotation;

	return $this;
    }

    /**
     * Get dotation
     *
     * @return string 
     */
    public function getDotation()
    {
	return $this->dotation;
    }

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     * @return Week
     */
    public function setIsClosed($isClosed)
    {
	$this->isClosed = $isClosed;

	return $this;
    }

    /**
     * Get isClosed
     *
     * @return boolean 
     */
    public function getIsClosed()
    {
	return $this->isClosed;
    }

    /**
     * Set doPublish
     *
     * @param \DateTime $doPublish
     * @return Week
     */
    public function setDoPublish($doPublish)
    {
	$this->doPublish = $doPublish;

	return $this;
    }

    /**
     * Get doPublish
     *
     * @return \DateTime 
     */
    public function getDoPublish()
    {
	return $this->doPublish;
    }

}
