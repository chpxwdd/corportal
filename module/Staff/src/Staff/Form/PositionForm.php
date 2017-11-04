<?php

namespace Staff\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\InputFilter\InputFilter,
    Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\EntityManager,
    DoctrineModule\Form\Element\ObjectSelect as DoctrineSelect;

class PositionForm extends Form
{

    /**
     *
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;

    public function __construct(EntityManager $em)
    {
	parent::__construct();

	$this->em = $em;
    }

    public function init($id = null)
    {

	$name = new Element\Text('name');
	$name->setLabel('Название');

	//  Doctrine select department element
	$department = new DoctrineSelect('department');
	$department->setLabel('Подразделение')
		->setOptions(array(
		    'object_manager' => $this->em,
		    'target_class' => '\Staff\Entity\Department',
		    'property' => 'name',
		    'allow_empty' => FALSE,
		    'empty_option' => '--- выберите из списка ---',
	));

	$chief = new Element\Checkbox('chief');
	$chief->setLabel('Руководящая позиция')
		->setAttribute('checked', null);

	$submit = new Element\Submit('submit');
	$submit->setValue('Сохранить');

	// IF edit form THEN set values AND adding hidden element to form
	if (null !== $id)
	{
	    // hidden name element
	    $rowId = new Element\Hidden('id');
	    $rowId->setValue($rowId);
	    $company = $this->em->getReference('\Staff\Entity\Company', $rowId);
	    $name->setValue($company->getCompany()->getId());
	    $description->setValue($company->getName());

	    $this->add($rowId);
	}

	$this->add($this->setDecorator($name));
	$this->add($this->setDecorator($chief));
	$this->add($this->setDecorator($department));
	$this->add($this->setDecorator($submit));
    }

    public function setDecorator($element)
    {

	if (($element instanceof Element\Text) ||
		($element instanceof Element\Password) ||
		($element instanceof Element\Select) ||
		($element instanceof Element\Textarea) ||
		($element instanceof DoctrineSelect))
	{
	    $element->setLabelAttributes(array('class' => 'form-group'));
	    $element->setAttributes(array('class' => 'form-control'));
	}
	elseif (($element instanceof Element\Submit) ||
		($element instanceof Element\Button))
	{

	    $element->setAttributes(array('class' => 'btn btn-default'));
	}
	elseif ($element instanceof Element\Checkbox)
	{
	    $element->setLabelAttributes(array('class' => 'checkbox'));
	}

	return $element;
    }

}
