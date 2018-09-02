<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\Identifier\Exception\InvalidIdentifier;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID v4 (random) identifier value object.
 */
abstract class Uuid4Value extends StringValue
{

    /**
     * @return static
     */
    final public static function generate()
    {
        return new static(UuidFactory::v4());
    }



    /** @inheritdoc */
    final protected function guardValue(string $string): void
    {
        if (!UuidValidator::isUuid4($string)) {
            throw new InvalidIdentifier();
        }
    }

}
