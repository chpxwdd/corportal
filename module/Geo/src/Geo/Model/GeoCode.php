<?php

namespace Geo\Model;

class GeoCode {

    const GEO_CODE_RUSSIAN = 'ru';
    const GEO_CODE_BELARUS = 'be';
    const GEO_CODE_CZECHREPUBLIC = 'cz';
    const GEO_CODE_ENGLAND = 'cz';
    const GEO_CODE_FRANCE = 'fr';
    const GEO_CODE_GERMAN = 'de';
    const GEO_CODE_LITHUANIA = 'lt';
    const GEO_CODE_LATVIA = 'lv';
    const GEO_CODE_ITALY = 'it';
    const GEO_CODE_PORTUGAL = 'pt';
    const GEO_CODE_POLAND = 'pl';
    const GEO_CODE_SPAIN = 'es';
    const GEO_CODE_UKRAINE = 'ua';
    const GEO_CODE_JAPAN = 'ja';

    private static $_useDefaultCode;

    public static function setDefaultCode($code) {
	static::$_useDefaultCode = $code;
    }

    public static function getDefaultCode() {
	if (empty(static::$_useDefaultCode)) {
	    static::$_useDefaultCode = self::GEO_CODE_RUSSIAN;
	}
	return static::$_useDefaultCode;
    }

}
