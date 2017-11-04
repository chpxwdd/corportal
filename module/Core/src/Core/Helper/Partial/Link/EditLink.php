<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Helper\Partial\Link;

use Core\Helper\Partial\Link\Link;
use Core\Helper\Partial\Glyph;

/**
 * Description of Action
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class EditLink extends Link {

    const CORE_HELPER_PARTIAL_LINK_GLYPH = 'pencil';

    public function __construct($href, $value, $attributes) {
	parent::__construct("Создать", $href, $value, new Glyph(self::CORE_HELPER_PARTIAL_LINK_GLYPH), $attributes);
    }

}
