<?php

namespace Species\Common\Value\String;

use Species\Common\Value\ValueObject;

/**
 * String value object interface.
 */
interface StringValueObject extends ValueObject
{

    /**
     * @param string $string
     * @return static
     */
    public static function fromString(string $string);



    /**
     * @inheritdoc
     * @return string
     */
    public function jsonSerialize(): string;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return string
     */
    public function toString(): string;

}
