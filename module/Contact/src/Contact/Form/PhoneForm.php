<?php

namespace Contact\Form;

use Core\Form\BaseForm;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
use Contact\Entity\Phone;
use Contact\Entity\Person;
use Contact\Model\Person as PersonModel;
use Contact\Model\Phone as PhoneModel;

/**
 * Phone add/edit form
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class PhoneForm extends BaseForm {

    public function __construct(EntityManager $em) {
	parent::__construct($em);
    }

    public function init(Person $person = NULL, Phone $phone = NULL) {

	parent::init();

	// Тип 
	$type = new Element\Select();
	$type->setName('type');
	$type->setLabel('Тип');
	$type->setValueOptions(array(
	  PhoneModel::CONTACT_PHONE_TYPE_HOME_VALUE => PhoneModel::CONTACT_PHONE_TYPE_HOME_TITLE,
	  PhoneModel::CONTACT_PHONE_TYPE_MOBILE_VALUE => PhoneModel::CONTACT_PHONE_TYPE_MOBILE_TITLE,
	));
	$type->setAttribute("style", "width:120px");
	// Номер
	$number = new Element\Text();
	$number->setName('number');
	$number->setLabel('Номер');
	$number->setAttribute("style", "width:120px");

	// Добавочный
	$extention = new Element\Text();
	$extention->setName('extention');
	$extention->setLabel('Добавочный');
	$extention->setAttribute('style', 'width:60px');

	// Персона к кому привязывается номер
	$person_id = new Element\Hidden();
	$person_id->setValue($person->getId());
	$person_id->setName('person_id');

	// Добавочный
	$submit = new Element\Submit();
	$submit->setValue("Сохранить");
	$submit->setName("phone_submit");

	$this->add($this->setDecorator($type));
	$this->add($this->setDecorator($number));
	$this->add($this->setDecorator($extention));
	$this->add($this->setDecorator($person_id));
	$this->add($this->setDecorator($submit));

	return $this;
    }

}
