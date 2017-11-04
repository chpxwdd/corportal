<?php

namespace Geo\Form;

use Core\Form\BaseForm;
use Zend\Form\Element;
use Zend\ServiceManager\ServiceManager;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect as DoctrineSelect;
use Geo\Model\GeoCode;

class GeoForm extends BaseForm {

    private $_em;
    private $_sm;

    public function __construct(EntityManager $em, ServiceManager $sm) {
	parent::__construct($em);
	$this->_sm = $sm;
//	var_dump($sm);
	$this->setAttribute('method', 'post')->setHydrator(new ClassMethods())->setInputFilter(new InputFilter());
    }

    /**
     * 
     * @param type $id
     */
    public function init($id = null) {

	//  Физ лицо
	$countryOptions = array(
	  'object_manager' => $this->_em,
	  'target_class' => '\Geo\Entity\Country',
	  'property' => 'title_' . GeoCode::getDefaultCode(),
	  'allow_empty' => FALSE,
	  'empty_option' => '...'
	);

	$this->add(array(
	  'name' => 'countryAc',
	  'type' => 'Core\Form\Element\Autocomplete',
	  'options' => array(
	    'label' => 'Страна',
	    'sm' => $this->_sm, // don't forget to send Service Manager
	  ),
	  'attributes' => array(
	    'required' => true,
	    'class' => 'form-control input-sm'
	  )
	));

	$country = new DoctrineSelect('country');
	$country->setLabel('Страна');
	$country->setOptions($countryOptions);

	$regionOptions = array(
	  'object_manager' => $this->_em,
	  'target_class' => '\Geo\Entity\Region',
	  'property' => 'title_' . GeoCode::getDefaultCode(),
	  'allow_empty' => FALSE,
	  'empty_option' => '...'
	);

	$region = new DoctrineSelect('region');
	$region->setLabel('Регион');
	$region->setOptions($regionOptions);

	$this->add($this->setDecorator($country));
	$this->add($this->setDecorator($region));
    }

}
