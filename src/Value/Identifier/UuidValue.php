<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\Identifier\Exception\InvalidIdentifier;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID (any version) identifier value object.
 */
abstract class UuidValue extends StringValue
{

    /** @inheritdoc */
    final protected function guardValue(string $string): void
    {
        if (UuidValidator::isUuid($string)) {
            throw new InvalidIdentifier();
        }
    }

}
