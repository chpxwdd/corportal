<?php

namespace Staff\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="staff_employee")
 * @ORM\Entity(repositoryClass="\Staff\Repository\Employee")
 */
class Employee
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $employee;

    /**
     * ONE EMPLOYE may be as ONE PERSON
     * 
     * @ORM\OneToOne(targetEntity="\Contact\Entity\Person")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;

    /**
     * ONE EMPLOYE may be as MANY USER
     * 
     * @ORM\OneToOne(targetEntity="\Dashboard\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * ONE EMPLOYEE may be worked on ONE COMPANY
     * 
     * @ORM\OneToOne(targetEntity="\Staff\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;
    
    /**
     * ONE employee may be worked in ONE Office
     * 
     * @ORM\OneToOne(targetEntity="\Corporate\Entity\Office")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id")
     */
    private $office;

    /**
     * ONE EMPLOYEE may be busy in ONE POSITION
     * 
     * @ORM\OneToOne(targetEntity="\Staff\Entity\Position")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $position;

    /**
     * 
     * @ORM\Column(type="string", name="extention", nullable=true, unique=true)
     */
    private $extention;

    /**
     * 
     * @ORM\Column(type="datetime", name="do_start_work", nullable=true)
     */
    private $doStartWork;

    /**
     * 
     * @ORM\Column(type="datetime", name="do_end_work", nullable=true)
     */
    private $doEndWork;

    /**
     * Get employee
     *
     * @return integer 
     */
    public function getEmployee()
    {
	return $this->employee;
    }

    /**
     * Set phone
     *
     * @param int $extention
     * @return Employee
     */
    public function setExtention($extention)
    {
	$this->extention = $extention;

	return $this;
    }

    /**
     * Get extention
     *
     * @return int 
     */
    public function getExtention()
    {
	return $this->extention;
    }

    /**
     * Set doStartWork
     *
     * @param \DateTime $doStartWork
     * @return Employee
     */
    public function setDoStartWork($doStartWork)
    {
	$this->doStartWork = $doStartWork;

	return $this;
    }

    /**
     * Get doStartWork
     *
     * @return \DateTime 
     */
    public function getDoStartWork()
    {
	return $this->doStartWork;
    }

    /**
     * Set doEndWork
     *
     * @param \DateTime $doEndWork
     * @return Employee
     */
    public function setDoEndWork($doEndWork)
    {
	$this->doEndWork = $doEndWork;

	return $this;
    }

    /**
     * Get doEndWork
     *
     * @return \DateTime 
     */
    public function getDoEndWork()
    {
	return $this->doEndWork;
    }

    /**
     * Set person
     *
     * @param \Contact\Entity\Person $person
     * @return Employee
     */
    public function setPerson(\Staff\Entity\Person $person = null)
    {
	$this->person = $person;

	return $this;
    }

    /**
     * Get person
     *
     * @return \Staff\Entity\Person
     */
    public function getPerson()
    {
	return $this->person;
    }

    /**
     * Set user
     *
     * @param \Dashboard\Entity\User $user
     * @return Employee
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
     * Set company
     *
     * @param \Staff\Entity\Company $company
     * @return Employee
     */
    public function setCompany(\Staff\Entity\Company $company = null)
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
     * Set position
     *
     * @param \Staff\Entity\Position $position
     * @return Employee
     */
    public function setPosition(\Staff\Entity\Position $position = null)
    {
	$this->position = $position;

	return $this;
    }

    /**
     * Get position
     *
     * @return \Staff\Entity\Position 
     */
    public function getPosition()
    {
	return $this->position;
    }

    
    /**
     * Set office
     *
     * @param \Corporate\Entity\Office $office
     * @return Employee
     */
    public function setOffice(\Corporate\Entity\Office $office = null)
    {
	$this->office = $office;

	return $this;
    }

    /**
     * Get office
     *
     * @return \Corporate\Entity\Office
     */
    public function getOffice()
    {
	return $this->company;
    }
    
}
