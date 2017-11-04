<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

class BaseController extends AbstractActionController {

    /** @var \Doctrine\ORM\EntityManager */
    protected $_em;
    /** @var \Zend\View\Helper\Placeholder */
    protected $_ph;

    /** @var string */
    protected $_title;

    /** @var string */
    protected $_lead;

    protected function __construct($title, $lead) {
	$this->_title = $title;
	$this->_lead = $lead;
    }

    protected function setPlaceholder() {

	$this->_ph = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');

	return $this;
    }

    /**
     * 
     * @return \Zend\View\Helper\Placeholder
     */
    protected function getPlaceholder() {

	if (null === $this->_ph) {
	    $this->setPlaceholder();
	}

	return $this->_ph;
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

}
