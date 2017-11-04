<?php

namespace Corporate\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Core\Helper\Partial\Grid;
use Corporate\Form\ContactForm as Blank;
use Corporate\Entity\Contact;

class ContactController extends AbstractActionController
{

    private $title;
    private $lead;
    private $blank;
    private $sidebar;

    public function __construct()
    {
	$this->title = 'Контакты';
	$this->lead = 'корпоративные ресурсы';


	/**
	 * move to view helper
	 * 
	 * @todo begin  
	 */
//	$items = array('item1' => 'lead1', 'item2' => 'lead2', 'item3' => 'lead3');
//	$list = (string) '';
//	foreach ($items as $key => $value)
//	{
//	    $title = sprintf('<a href="#">%s</a>', $key);
//	    $lead = sprintf('<p class="text-muted">%s</p>', $value);
//	    $list .= sprintf('<li class="list-group-item">%s%s</li>', $title, $lead);
//	}
//	$this->sidebar = sprintf('<h3>Сервисы</h3><ul class="list-group">%s</ul>', $list);
	/**
	 * @todo end
	 */
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

	$placeholder->getContainer('sidebar')->set($this->sidebar);

	$page = (int) $this->params()->fromRoute('page', 0);
	$om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	$repository = $om->getRepository("\Corporate\Entity\Contact");
	$rowset = $repository->findAll();

	$paginator = new Paginator(new ArrayAdapter($rowset));
	$paginator->setCurrentPageNumber($page);
	$paginator->setItemCountPerPage(10);
	$paginator->setPageRange(4);

	$headers = array('ФИО', 'Дата Рождения', 'Пол');
	$rows = array();
	foreach ($paginator as $row):
	    $rows[$row->getId()] = array(
		$row->getFullname(),
		$row->getBirth()->format('d.m.Y'),
		$row->getGender() == 'm' ? 'муж.' : 'жен.',
	    );
	endforeach;

	$grid = new Grid($rows, $headers, 'Список');
	$grid->setFeature('paginator', $paginator);
	$grid->setId((string) 'contact');
	$grid->setClass(array('table table-responsive table-hover'));

	$viewmodel = new ViewModel();
	$viewmodel->setVariable('grid', $grid);
	$viewmodel->setVariable('paginator', $paginator);
	return $viewmodel;
    }

    /**
     * view contact action 
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function viewAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('контактное лицо');
	$placeholder->getContainer('lead')->set('просмотр');

	$viewmodel = new ViewModel();

//	$viewmodel->setTerminal(FALSE);

	return $viewmodel;
    }

    /**
     * add contact action 
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function addAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('контактное лицо');
	$placeholder->getContainer('lead')->set('создать');

	$blank = new Blank();
	$builder = new AnnotationBuilder();
	$form = $builder->createForm($blank);

	$request = $this->getRequest();
	if ($request->isPost())
	{
	    $form->bind($blank);
	    $form->setData($request->getPost());

	    if ($form->isValid())
	    {
		$data = get_object_vars($form->getData());
		$contact = new Contact();
		$contact->setData($data);

		$om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$om->persist($contact);
		$om->flush();

		$this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_SUCCESS);
		$this->flashMessenger()->addMessage('Контакт успешно сохранен в базе данных');

		return $this->redirect()->toRoute('corporate/contact');
		
	    }
	}

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('form', $form);
	
	return $viewmodel;
    }

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function editAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('редактировать');
	$placeholder->getContainer('lead')->set('контактное лицо');

	$id = (int) $this->params()->fromRoute('id');

	$om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	$contact = $om->getRepository("\Corporate\Entity\Contact")->find($id);


	if (!$contact)
	{
	    $this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_DANGER);
	    $this->flashMessenger()->addMessage('Контакт c id="' . $id . '" не найден в базе данных');
	    return $this->redirect()->toRoute('corporate/contact', array('action' => 'index'));
	}

	$this->blank->setLabel('Редактирование данных');
	$this->blank->bind($contact);
	
	$request = $this->getRequest();
	if ($request->isPost())
	{
	    $this->blank->setData($contact->getArrayCopy());
	    
	    if ($this->blank->isValid())
	    {
		$contact->setData($contact->getArrayCopy());
		$om->persist($contact);
		$om->flush();
		
		$this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_SUCCESS);
		$this->flashMessenger()->addMessage('Контакт успешно сохранен в базе данных');

		return $this->redirect()->toRoute('corporate/contact');
	    }
	}

	$viewmodel = new ViewModel();
	$viewmodel->setTerminal(FALSE);
	$viewmodel->setVariable('form', $this->blank);
	return $viewmodel;
    }

}
