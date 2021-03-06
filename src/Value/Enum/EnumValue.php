<?php

namespace Species\Common\Value\Enum;

use Species\Common\Value\Enum\Exception\InvalidEnumIndex;
use Species\Common\Value\Enum\Exception\InvalidEnumValue;
use Species\Common\Value\String\StringValue;

/**
 * Abstract enum value object.
 */
abstract class EnumValue extends StringValue implements \IteratorAggregate, EnumValueObject
{

    /** @var array */
    private static $singletons = [];

    /** @var int */
    private $index;



    /** @inheritdoc */
    final public static function getSingletons(): array
    {
        if (!isset(self::$singletons[static::class])) {
            self::$singletons[static::class] = [];
            $singletons =& self::$singletons[static::class];
            foreach (static::ENUM as $index => $enum) {
                $singletons[$enum] = parent::fromString($enum);
                $singletons[$enum]->index = $index;
            }
        }

        return self::$singletons[static::class];
    }



    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        $singletons = static::getSingletons();

        if (!isset($singletons[$string])) {
            throw new InvalidEnumValue();
        }

        return $singletons[$string];
    }

    /** @inheritdoc */
    final public static function fromIndex(int $index)
    {
        if (!isset(static::ENUM[$index])) {
            throw new InvalidEnumIndex();
        }

        return static::fromString(static::ENUM[$index]);
    }



    /** @inheritdoc */
    final public function getIndex(): int
    {
        return $this->index;
    }



    /** @inheritdoc */
    final public function count(): int
    {
        return count(static::ENUM);
    }

    /**
     * @return \Generator|static[]
     */
    final public function getIterator(): \Generator
    {
        return yield from static::getSingletons();
    }

}
