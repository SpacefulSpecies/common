<?php

namespace Species\Common\Value\Uuid;

use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\String\StringValue;

/**
 * Abstract UUID v1 (time/node) value object.
 */
abstract class Uuid1Value extends StringValue implements UuidValueObject
{

    /** @inheritdoc */
    final public static function generate()
    {
        return parent::fromString(UuidFactory::v1());
    }



    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (!UuidValidator::isUuid1($string)) {
            throw new InvalidUuid();
        }

        return parent::fromString($string);
    }

}
