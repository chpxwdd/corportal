<?php

namespace Staff\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Staff\Entity\Employee;
use Staff\Form\EmployeeForm;

class EmployeeController extends AbstractActionController
{

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string 
     */
    private $lead;
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    protected $_em;

    /**
     * class constructor
     */
    public function __construct()
    {
	$this->title = 'сотрудники';
	$this->lead = 'служба персонала';
    }

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(EntityManager $em)
    {
	$this->_em = $em;
	return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
	if (null === $this->_em)
	{
	    $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
	}
	return $this->_em;
    }

    /**
     * action index employee list
     * 
     * @access public
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set($this->title);
	$placeholder->getContainer('lead')->set($this->lead);

	// create view  script data
	$viewmodel = new ViewModel();

	return $viewmodel;
    }

    /**
     * action add employee form
     * 
     * @access public
     * @return Zend\View\Model\ViewModel
     */
    public function addAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('новый сотрудник');
	$placeholder->getContainer('lead')->set($this->title);

	$em = $this->getEntityManager();

	$employee = new Employee();

	// create form
	$form = new EmployeeForm($em);
	
	
	$form->init();

	// create view  script data
	$viewmodel = new ViewModel();
	$viewmodel->setVariable('form', $form);

	return $viewmodel;
    }

}
