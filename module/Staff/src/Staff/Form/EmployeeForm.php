<?php

namespace Staff\Form;

use Core\Form\BaseForm;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect as DoctrineSelect;

class EmployeeForm extends BaseForm {

    private $_em;
    
    public function __construct(EntityManager $em) {

	parent::__construct($em);
	$this->_em = $em;
	
	$this->setAttribute('method', 'post')->setHydrator(new ClassMethods())->setInputFilter(new InputFilter());
    }

    public function init($id = null) {

	//  Zend input datetime element
	$doStartWork = new Element\Date('do_start_work');
	$doStartWork->setLabel('Дата начала работы');


	//  Zend input text element
	$extention = new Element\Text('extention');
	$extention->setLabel('Внутренний телефон');
	$extention->setAttribute("style", "width:100px");


	//  Физ лицо
	$personOptions = array(
	  'object_manager' => $this->_em,
	  'target_class' => '\Contact\Entity\Person',
	  'property' => 'sname',
	  'allow_empty' => FALSE,
	  'empty_option' => '--- выберите из списка ---'
	);
	$person = new DoctrineSelect('person');
	$person->setLabel('Физическое лицо');
	$person->setOptions($personOptions);

	//  Должность
	$positionOptions = array(
	  'object_manager' => $this->_em,
	  'target_class' => '\Staff\Entity\Position',
	  'property' => 'name',
	  'allow_empty' => FALSE,
	  'empty_option' => '--- выберите из списка ---'
	);
	$position = new DoctrineSelect('position');
	$position->setLabel('Дожность');
	$position->setOptions($positionOptions);

	//  Офис
	$officeOptions = array(
	  'object_manager' => $this->_em,
	  'target_class' => '\Corporate\Entity\Office',
	  'property' => 'title',
	  'allow_empty' => FALSE,
	  'empty_option' => '--- выберите из списка ---'
	);
	$office = new DoctrineSelect('office');
	$office->setLabel('Офис');
	$office->setOptions($officeOptions);

	// Сохранение
	$submit = new Element\Submit('submit');
	$submit->setValue('Создать');


	// IF edit form THEN set values AND adding hidden element to form
	if (null !== $id) {
	    // для существующего сотрудника добавляем поле дата окончания работы
	    $doEndWork = new Element\Date('do_end_work');
	    $doEndWork->setLabel('Дата окончания работы');

	    // hidden name element
	    $rowId = new Element\Hidden('id');
	    $rowId->setValue($rowId);

	    // Получаем данные сотрудника по ID
	    $employee = $this->_em->find('\Staff\Entity\Employee', $id);

	    // set field values 
	    $position->setValue($employee->getPosition());
	    $person->setValue($employee->getContact());
	    $office->setValue($employee->getOffice());
	    $doStartWork->setValue($employee->getDoStartWork());
	    $doEndWork->setValue($employee->getDoEndWork());
	    $extention->setValue($employee->getExtention()->getId());

	    $this->add($rowId);
	    $submit->setValue('Сохранить');
	}

	$this->add($this->setDecorator($person));
	$this->add($this->setDecorator($position));
	$this->add($this->setDecorator($office));
	$this->add($this->setDecorator($doStartWork));
	if (NULL !== $id) {
	    $this->add($this->setDecorator($doEndWork));
	}
	$this->add($this->setDecorator($extention));
	$this->add($this->setDecorator($submit));
    }

}
