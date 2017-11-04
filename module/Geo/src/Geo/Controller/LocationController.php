<?php

namespace Geo\Controller;

use Core\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Geo\Entity\Country;
use Geo\Entity\City;
use Geo\Entity\Region;
use Geo\Form\GeoForm;
use Geo\Model\GeoCode;

class LocationController extends BaseController{

    public function __construct() {
	parent::__construct('Location', 'Geo');
    }

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction() {
	$this->getPlaceholder()->getContainer("title")->set($this->_title);
	$this->getPlaceholder()->getContainer("lead")->set($this->_lead);

	$request = $this->getRequest();
	$form = new GeoForm($this->getEntityManager(), $this->getServiceLocator());
	$form->init();

	$this->getServiceLocator()->get('viewhelpermanager')->get('headScript')->appendFile('/js/module/geo/geo.js');

	
	$viewmodel = new ViewModel();
	$viewmodel->setVariable('geoForm', $form);
	$viewmodel->setTerminal($request->isXmlHttpRequest());

	return $viewmodel;
    }

    public function cityAction() {

	$id = (int) $this->params()->fromRoute('id', 0);
	$regionsRepo = $this->getEntityManager()->getRepository('\Geo\Entity\City');
	if (!empty($id)) {
	    $rowset = $regionsRepo->findBy(array("region" => $id));
	}
	else {
	    $rowset = $regionsRepo->findAll();
	}

	$regions = array();
	foreach ($rowset AS $region) {
	    $regions[$region->getId()] = $region->getTitle(GeoCode::getDefaultCode());
	}

//	print"<pre>";die(var_dump($array));

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(TRUE);
	$viewmodel->setVariable('regions', $regions);

	return $viewmodel;
    }

    public function regionAction() {

	$id = (int) $this->params()->fromRoute('id', 0);
	$regionsRepo = $this->getEntityManager()->getRepository('\Geo\Entity\Region');
	if (!empty($id)) {
	    $rowset = $regionsRepo->findBy(array("country" => $id));
	}
	else {
	    $rowset = $regionsRepo->findAll();
	}

	$regions = array();
	foreach ($rowset AS $region) {
	    $regions[$region->getId()] = $region->getTitle(GeoCode::getDefaultCode());
	}

//	print"<pre>";die(var_dump($array));

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(TRUE);
	$viewmodel->setVariable('regions', $regions);

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
