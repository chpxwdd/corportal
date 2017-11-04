<?php

namespace Contact\Form;

use Doctrine\ORM\EntityManager;
use Contact\Entity\Phone;
use Contact\Entity\Person;

/**
 * Phone add/edit form
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class PersonPhoneForm extends PhoneForm {

    public function __construct(EntityManager $em) {
	parent::__construct($em);
    }

    public function init(Person $person = NULL, Phone $phone = NULL) {


	parent::init($person, $phone);
	$this->setAttribute("class", "form-inline");

	$this->get('phone_submit')
	    ->setName('add_phone_submit')
	    ->setValue('Добавить')
	    ->setAttribute('id', 'add_phone_submit');
	$this->get('number')
	    ->setLabel('')
	    ->setAttribute('placeholder', 'номер');
	$this->get('extention')
	    ->setLabel('')
	    ->setAttribute('placeholder', 'доб.');

	return $this;
    }

}
