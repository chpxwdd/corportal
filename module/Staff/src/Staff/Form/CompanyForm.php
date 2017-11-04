<?php

namespace Staff\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\InputFilter\InputFilter,
    Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\EntityManager,
    DoctrineModule\Form\Element\ObjectSelect as DoctrineSelect;


class CompanyForm extends Form
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

	parent::__construct('company');

	$this->em = $em;

	$this->setAttribute('method', 'post')
		->setHydrator(new ClassMethods())
		->setInputFilter(new InputFilter());
    }

    public function init($id = null)
    {

	$name = new Element\Text('name');
	$name->setLabel('Название');

	$description = new Element\Text('description');
	$description->setLabel('описание');

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
	$this->add($this->setDecorator($description));
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
