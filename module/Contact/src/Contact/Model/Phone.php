<?php

namespace Contact\Model;

abstract class Phone {

    /** @var string */
    const CONTACT_PHONE_TYPE_HOME_TITLE = "Домашний";

    /** @var string */
    const CONTACT_PHONE_TYPE_HOME_VALUE = "home";

    /** @var string */
    const CONTACT_PHONE_TYPE_MOBILE_TITLE = "Мобильный";

    /** @var string */
    const CONTACT_PHONE_TYPE_MOBILE_VALUE = "mobile";

    public static function getPhoneTypeTitle($type) {
	switch ($type) {
	    case self::CONTACT_PHONE_TYPE_HOME_VALUE:
		return self::CONTACT_PHONE_TYPE_HOME_TITLE;
	    case self::CONTACT_PHONE_TYPE_MOBILE_VALUE:
		return self::CONTACT_PHONE_TYPE_MOBILE_TITLE;
	}
    }

}
