<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\String\StringValueObject;

/**
 * UUID value object interface.
 */
interface UuidValueObject extends StringValueObject
{

    /**
     * @return static
     */
    public static function generate();

}
