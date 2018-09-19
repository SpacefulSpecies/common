<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\Identifier\Exception\InvalidIdentifier;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID (any version) identifier value object.
 */
abstract class UuidValue extends StringValue implements UuidValueObject
{

    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (UuidValidator::isUuid($string)) {
            throw new InvalidIdentifier();
        }

        return new static($string);
    }

}
