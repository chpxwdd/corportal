<?php

namespace Staff\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\InputFilter\InputFilter,
    Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\EntityManager,
    DoctrineModule\Form\Element\ObjectSelect as DoctrineSelect;

class DepartmentForm extends Form
{

    /**
     *
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;

    /**
     * class constructor
     * 
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {

	parent::__construct('department');

	$this->em = $em;

	$this->setAttribute('method', 'post')
		->setHydrator(new ClassMethods())
		->setInputFilter(new InputFilter());
    }

    public function init($id = null)
    {

	//  Add doctrine select company element
	$company = new DoctrineSelect('company');
	$company->setLabel('компания')
		->setOptions(array(
		    'object_manager' => $this->em,
		    'target_class' => '\Staff\Entity\Company',
		    'property' => 'name',
		    'allow_empty' => FALSE,
		    'empty_option' => '--- выберите из списка ---',
	));

	$name = new Element\Text('name'); // input[text] name element
	$name->setLabel('Название');

	$parent = new DoctrineSelect('parent'); // select parent element
	$parent->setLabel('Подчинение')
		->setOptions(array(
		    'object_manager' => $this->em,
		    'target_class' => '\Staff\Entity\Department',
		    'property' => 'name',
		    'allow_empty' => FALSE,
		    'empty_option' => '--- выберите из списка ---',
	));

	$submit = new Element\Submit('submit'); // submit element
	$submit->setValue('Сохранить');

	// IF edit form THEN set values AND adding hidden element to form
	if (null !== $id)
	{
	    // hidden name element
	    $rowId = new Element\Hidden('id');
	    $rowId->setValue($rowId);

	    $department = $this->em->find('\Staff\Entity\Department', $id);
	    $name->setValue($department->getName());
	    $parent->setValue($department->getParent()->getId());
	    $company->setValue($department->getCompany()->getId());

	    $this->add($rowId);
	}

	$this->add($this->setDecorator($company));
	$this->add($this->setDecorator($parent));
	$this->add($this->setDecorator($name));
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
