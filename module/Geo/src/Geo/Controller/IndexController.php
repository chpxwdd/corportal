<?php

namespace Geo\Controller;

use Core\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Geo\Entity\Country;
use Geo\Entity\City;
use Geo\Entity\Region;
use Geo\Form\GeoForm;
use Geo\Model\GeoCode;

class IndexController extends BaseController {

    public function __construct() {
	$this->_title = 'Geo';
	$this->_lead = 'Library';
    }

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction() {
	$this->getPlaceholder()->getContainer("title")->set($this->_title);
	$this->getPlaceholder()->getContainer("lead")->set($this->_lead);

	$request = $this->getRequest();

	$form = new GeoForm($this->getEntityManager());
	$form->init();

	$viewmodel = new ViewModel();
	$is_xmlhttprequest = 1;
	if (!$request->isXmlHttpRequest()) {
	    //if NOT using Ajax
	    $is_xmlhttprequest = 0;
	    if ($request->isPost()) {
		$form->setData($request->getPost());
		if ($form->isValid()) {
//		    $this->savetodb($form->getData());
		}
	    }
	}

	$this->getServiceLocator()->get('viewhelpermanager')->get('headScript')->appendFile('/js/module/geo/geo.js');
	$viewmodel->setVariable('geoForm', $form);
	$viewmodel->setTerminal($request->isXmlHttpRequest());
	// is_xmlhttprequest is needed for check this form is in modal dialog or not
	// in view
	$viewmodel->setVariable('is_xmlhttprequest', $is_xmlhttprequest);
	return $viewmodel;
    }

    public function regionAction() {
	
	$viewmodel = new ViewModel();
//	$viewmodel->setTerminal(TRUE);
	return $viewmodel;
    }

//
//    public function validatepostajaxAction() {
//	$form = $this->getForm();
//	$request = $this->getRequest();
//	$response = $this->getResponse();
//
//	$messages = array();
//	if ($request->isPost()) {
//	    $form->setData($request->getPost());
//	    if (!$form->isValid()) {
//		$errors = $form->getMessages();
//		foreach ($errors as $key => $row) {
//		    if (!empty($row) && $key != 'submit') {
//			foreach ($row as $keyer => $rower) {
//			    //save error(s) per-element that
//			    //needed by Javascript
//			    $messages[$key][] = $rower;
//			}
//		    }
//		}
//	    }
//
//	    if (!empty($messages)) {
//		$response->setContent(\Zend\Json\Json::encode($messages));
//	    }
//	    else {
//		//save to db <img draggable="false" class="emoji" alt="😉" src="https://s0.wp.com/wp-content/mu-plugins/wpcom-smileys/twemoji/2/svg/1f609.svg">
//		$this->savetodb($form->getData());
//		$response->setContent(\Zend\Json\Json::encode(array('success' => 1)));
//	    }
//	}
//
//	return $response;
//    }
}
