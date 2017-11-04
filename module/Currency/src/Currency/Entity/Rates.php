<?php

namespace Currency\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="currency_rates")
 * @ORM\Entity(repositoryClass="\Currency\Repository\Rates")
 */
class Rates
{

    /**
     * @var int 
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=3)
     */
    protected $abbr;

    /**
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    protected $date;

    /**
     * @var float
     * 
     * @ORM\Column(name="_usd", type="float")
     */
    protected $usd;

    /**
     * @var float
     * 
     * @ORM\Column(name="_eur", type="float")
     */
    protected $eur;

    /**
     * 
     * @return int
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getAbbr()
    {
	return $this->abbr;
    }

    /**
     * 
     * @param s $abbr
     */
    public function setAbbr($abbr)
    {
	$this->abbr = $abbr;
    }

    /**
     * 
     * @return string
     */
    public function getDate()
    {
	return $this->date;
    }

    public function setDate($date)
    {
	$this->date = new \DateTime($date);
    }

    public function getEur()
    {
	return (string) $this->eur;
    }

    public function setEur($eur)
    {
	$this->eur = $eur;
    }

    public function getUsd()
    {
	return $this->usd;
    }

    public function setUsd($usd)
    {
	$this->usd = $usd;
    }

}
