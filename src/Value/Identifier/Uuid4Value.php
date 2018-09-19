<?php

namespace Species\Common\Value\Identifier;

use Species\Common\Value\Identifier\Exception\InvalidIdentifier;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID v4 (random) identifier value object.
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
            throw new InvalidIdentifier();
        }

        return new static($string);
    }

}
