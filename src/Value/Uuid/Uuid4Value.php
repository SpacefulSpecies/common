<?php

namespace Species\Common\Value\Uuid;

use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID v4 (random) value object.
 */
abstract class Uuid4Value extends StringValue implements UuidValueObject
{

    /** @inheritdoc */
    final public static function generate()
    {
        return new static(UuidFactory::v4());
    }



    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (!UuidValidator::isUuid4($string)) {
            throw new InvalidUuid();
        }

        return new static($string);
    }

}
