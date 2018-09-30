<?php

namespace Species\Common\Value\Enum;

use Species\Common\Value\String\StringValueObject;

/**
 * Enum value object interface.
 */
interface EnumValueObject extends \Countable, \Traversable, StringValueObject
{

    /**
     * A numeric array of the enum string values.
     * eg: ['apple', 'banana', 'tomato']
     *
     * @const string[]
     */
    public const ENUM = [];



    /**
     * Get all the enum values.
     *
     * @return static[]
     */
    public static function getSingletons(): array;



    /**
     * Retrieve the enum value from its index.
     *
     * @param int $index
     * @return static
     */
    public static function fromIndex(int $index);



    /**
     * @return int
     */
    public function getIndex(): int;

}
