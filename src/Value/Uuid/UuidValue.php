<?php

namespace Species\Common\Value\Uuid;

use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID (any version, including nil) value object.
 */
abstract class UuidValue extends StringValue implements UuidValueObject
{

    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (UuidValidator::isUuid($string)) {
            throw new InvalidUuid();
        }

        return new static($string);
    }

}
