<?php

namespace Contact\Controller;

use Core\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Core\Helper\Partial\Grid;
use Core\Helper\Partial\Link;
use Contact\Form\PersonForm;
use Contact\Form\PersonPhoneForm;
use Contact\Entity\Person;
use Contact\Entity\Phone;
use Contact\Model\Phone as PhoneModel;

//class PersonController extends AbstractActionController {
class PersonController extends BaseController {

    public function __construct() {
	parent::__construct('Физическое лицо', 'Картотека');
    }

    public function indexAction() {

	$this->getPlaceholder()->getContainer('title')->set($this->_title);
	$this->getPlaceholder()->getContainer('lead')->set($this->_lead);

	$paginator = new Paginator(new ArrayAdapter($this->getEntityManager()->getRepository('\Contact\Entity\Person')->findAll()));
	$paginator->setCurrentPageNumber((int) $this->params()->fromRoute('page', 0));
	$paginator->setItemCountPerPage(10);
	$paginator->setPageRange(4);

	$headers = array('ФИО', 'Дата рождения', 'Операции');
	$rows = array();

	foreach ($paginator as $row) {

	    $editAction = new Link\EditLink($this->url()->fromRoute('contact/person', array(
		  'action' => 'edit', 'id' => $row->getId()
		)), '', array("alt" => "Редактировать", "class" => "btn btn-link"));

	    $removeAction = new Link\RemoveLink($this->url()->fromRoute('contact/person', array(
		  'action' => 'remove', 'id' => $row->getId()
		)), '', array("alt" => "Удалить", "class" => "btn btn-link"));

	    $actions = array(
	      $editAction->render(),
	      $removeAction->render(),
	    );
	    $rows[$row->getId()] = array(
	      sprintf("%s %s %s", $row->getSname(), $row->getFname(), $row->getMname()),
	      $row->getBirth()->format('d.m.Y'),
	      implode(" ", $actions)
	    );
	}

	$grid = new Grid($rows, $headers, 'Список');
	$grid->setFeature('paginator', $paginator);
	$grid->setId((string) 'contact');
	$grid->setClass(array('table table-responsive table-hover'));

	$grid->addAction(new Link\AddLink($this->url()->fromRoute('contact/person', array(
	      'action' => 'add'
	    )), 'Создать', array("alt" => "Создать", "class" => "btn btn-default btn-sm")));



	$viewmodel = new ViewModel();
	$viewmodel->setVariable('grid', $grid);
	$viewmodel->setVariable('paginator', $paginator);

	return $viewmodel;
    }

    /**
     * add contact action 
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function addAction() {

	$this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_DANGER);
	$this->flashMessenger()->addMessage("Данные добавлены В БД");

	$this->getPlaceholder()->getContainer('title')->set("Создать");
	$this->getPlaceholder()->getContainer('lead')->set($this->_title);

	$person = NULL;
	// если сохраняемся
	if ($this->request->isPost()) {
	    $person = new Person();
	    $person->setData($this->getRequest()->getPost());
	    $this->getEntityManager()->persist($person);
	    $this->getEntityManager()->flush();
	}

	$personForm = new PersonForm($this->getEntityManager());
	$personForm->init($person);

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('personForm', $personForm);

	return $viewmodel;
    }

    /**
     * Edit action
     * 
     * @return ViewModel
     */
    public function editAction() {

	$this->getPlaceholder()->getContainer('title')->set("Редактировать");
	$this->getPlaceholder()->getContainer('lead')->set($this->_title);
	$this->getServiceLocator()->get('viewhelpermanager')->get('headScript')->appendFile('/js/module/contact/contact.js');

	$id = (int) $this->params()->fromRoute('id', 0);
	$person = $this->getEntityManager()->find('\Contact\Entity\Person', $id);

	if (!$person) {
	    return $this->redirect()->toRoute('contact/person', array('action' => 'index'));
	}

	$personForm = new PersonForm($this->getEntityManager());

	if ($this->request->isPost()) {

	    if (!empty($this->getRequest()->getPost()->person_submit)) {
		$person->setData($this->getRequest()->getPost());
		$this->getEntityManager()->flush();
	    }

	    if (!empty($this->getRequest()->getPost()->add_phone_submit)) {

		$data = $this->getRequest()->getPost();
		$data->person = $person;

		$phone = new Phone();
		$phone->setData($data);
		if (empty($data->id)) {
		    $this->getEntityManager()->persist($phone);
		}
		$this->getEntityManager()->flush();
	    }
	}
	// Список телефонов
	$rowset = $this->getEntityManager()->getRepository('\Contact\Entity\Phone')->findBy(array("person" => $id));

	$headers = array('Тип', 'Номер', 'Добавочный', '');
	$rows = array();
	foreach ($rowset as $row): $editAction = new Link\EditLink($this->url()->fromRoute('contact/person', array(
		  'action' => 'edit', 'id' => $row->getId()
		)), '', array("alt" => "Редактировать", "class" => "btn btn-link"));

	    $removeAction = new Link\RemoveLink($this->url()->fromRoute('contact/person', array(
		  'action' => 'remove', 'id' => $row->getId()
		)), '', array("alt" => "Удалить", "class" => "btn btn-link"));

	    $actions = array(
	      $editAction->render(),
	      $removeAction->render(),
	    );
	    $rows[$row->getId()] = array(
	      PhoneModel::getPhoneTypeTitle($row->getType()),
	      $row->getNumber(),
	      $row->getExtention(),
	      implode(" ", $actions)
	    );
	endforeach;

	$gridPhones = new Grid($rows, $headers, (string) '');
	$gridPhones->setId((string) 'person_phone');
	$gridPhones->setClass(array('table table-responsive table-hover'));

	$phoneForm = new PersonPhoneForm($this->getEntityManager());
	// Список телефонов

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('personForm', $personForm->init($person));
	$viewmodel->setVariable('phoneForm', $phoneForm->init($person));
	$viewmodel->setVariable('gridPhones', $gridPhones);

	return $viewmodel;
    }

    /**
     * delete person action
     * 
     * @return array
     */
    public function deleteAction() {

	$id = (int) $this->params()->fromRoute('id', 0);

	if (!$id) {
	    return $this->redirect()->toRoute('contcat/person');
	}

	$request = $this->getRequest();
	if ($request->isPost()) {
	    $del = $request->getPost('del', 'No');

	    if ($del == 'No') {
		return $this->redirect()->toRoute('person');
	    }
	    $id = (int) $request->getPost('id');
	    $person = $this->getEntityManager()->find('Contact\Entity\Person', $id);
	    if ($person) {
		$this->getEntityManager()->remove($person);
		$this->getEntityManager()->flush();
	    }

	    // Redirect to list of albums
	    return $this->redirect()->toRoute('person');
	}

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('person', $this->getEntityManager()->find('Contact\Entity\Person', $id));

	return $viewmodel;
    }

}
