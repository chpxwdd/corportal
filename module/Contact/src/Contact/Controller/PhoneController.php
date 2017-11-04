<?php

namespace Contact\Controller;

use Doctrine\ORM\EntityManager;
use Core\Controller\BaseController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Core\Helper\Partial\Grid;
use Contact\Form\PhoneForm;
use Contact\Entity\Phone;

class PhoneController extends BaseController {

    public function __construct() {
	$this->_title = 'Телефоный номер';
	$this->_lead = 'Картотека';
    }

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(EntityManager $em) {
	$this->_em = $em;
	return $this;
    }

    /**
     * Gets the EntityManager
     * 
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager() {
	if (null === $this->_em) {
	    $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
	}

	return $this->_em;
    }

    /** @return Zend\View\Model\ViewModel */
    public function indexAction() {
	$this->getPlaceholder()->getContainer('title')->set($this->_title);
	$this->getPlaceholder()->getContainer('lead')->set($this->_lead);

	$viewmodel = new ViewModel();
	return $viewmodel;
    }

    /**
     * add contact action 
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function addAction() {

	$this->getPlaceholder()->getContainer('title')->set("Создать");
	$this->getPlaceholder()->getContainer('lead')->set($this->_title);
	 
	$id = (int) $this->params()->fromRoute('id', 0);
	$person = $this->getEntityManager()->find('\Contact\Entity\Person', $id);
	
//
	if ($this->request->isPost()) {
	
	    $data = $this->getRequest()->getPost();
	    $phone = new Phone();
	    $data->person = $person->getId();
	    $phone->setData($data);
	    $this->getEntityManager()->persist($phone);
	    $this->getEntityManager()->flush();
	    
	    return $this->redirect()->toUrl('contact/person/edit/' . $id);
	}

	// create form
	$form = new PhoneForm($this->getEntityManager());
	$form->init($person);

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('form', $form);
	return $viewmodel;
    }


}
