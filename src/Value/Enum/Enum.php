<?php

namespace Species\Common\Value\Enum;

use Species\Common\Value\Enum\Exception\InvalidEnumValue;
use Species\Common\Value\String\StringValue;

/**
 * Abstraction of an enum.
 */
abstract class Enum extends StringValue implements EnumValueObject
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
            foreach (static::ENUM as $index => $enum) {
                $singleton = new static($enum);
                $singleton->index = $index;
                self::$singletons[static::class][$enum] = $singleton;
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
            throw new InvalidEnumValue();
        }

        return static::fromString(static::ENUM[$index]);
    }



    /** @inheritdoc */
    final public function getIndex(): int
    {
        return $this->index;
    }

}
