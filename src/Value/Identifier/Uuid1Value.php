<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\Identifier\Exception\InvalidIdentifier;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID v1 (time/node) identifier value object.
 */
abstract class Uuid1Value extends StringValue
{

    /**
     * @return static
     */
    final public static function generate()
    {
        return new static(UuidFactory::v1());
    }



    /** @inheritdoc */
    final protected function guardValue(string $string): void
    {
        if (!UuidValidator::isUuid1($string)) {
            throw new InvalidIdentifier();
        }
    }

}
