<?php

namespace Staff\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Staff\Entity\Position;
use Staff\Form\PositionForm;

class PositionController extends AbstractActionController
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
	$this->title = 'позиция';
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
     * 
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
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function addAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('Создать');
	$placeholder->getContainer('lead')->set($this->title);

	// build position form
	$this->_em = $this->getEntityManager();
	$form = new PositionForm($this->_em);
	$form->init();

	// create view  script data
	$viewmodel = new ViewModel();
	$viewmodel->setVariable('form', $form);

	return $viewmodel;
    }

}
