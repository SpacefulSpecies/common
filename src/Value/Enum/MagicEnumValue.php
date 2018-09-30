<?php

namespace Species\Common\Value\Enum;

use Species\Common\Value\Enum\Exception\InvalidEnumValue;

/**
 * Abstract magic method enum value object.
 *
 * It provides static factory methods using magic callStatic(), eg:
 *   Fruit::apple(), Fruit::banana(), Fruit::tomato()
 *
 * It provides bool validation methods using magic call() with an "is" or "in" prefix, eg:
 *   $fruit->isApple(), $status->inValidation()
 *
 * Magic call() and callStatic() will search for lookalikes, eg:
 *   "friedPotato", "fried-potato", "FRIED_POTATO", "fried potAto", ...
 */
abstract class MagicEnumValue extends EnumValue
{

    /** @var array */
    private static $lookalikes = [];



    /**
     * @param string $name
     * @param array  $arguments
     * @return static
     */
    final public static function __callStatic(string $name, array $arguments)
    {
        try {
            return static::fromLookalike($name);
        } catch (InvalidEnumValue $e) {
            throw static::undefinedMethod($name);
        }
    }



    /**
     * @param string $name
     * @param array  $arguments
     * @return bool
     */
    final public function __call(string $name, array $arguments): bool
    {
        $prefix = substr($name, 0, 2);
        $lookalike = substr($name, 2);
        if (!in_array($prefix, ['is', 'in']) || $lookalike === '') {
            throw static::undefinedMethod($name);
        }

        try {
            $enum = static::fromLookalike($lookalike);
        } catch (InvalidEnumValue $e) {
            throw static::undefinedMethod($name);
        }

        return $this->getIndex() === $enum->getIndex();
    }



    /**
     * @param string $string
     * @return static
     */
    final protected static function fromLookalike(string $string)
    {
        $singletons = static::getSingletons();
        if (isset($singletons[$string])) {
            return $singletons[$string];
        }

        if (!isset(self::$lookalikes[static::class])) {
            self::$lookalikes[static::class] = [];
        }
        $lookalikes =& self::$lookalikes[static::class];

        if (!isset($lookalikes[$string])) {
            $lookalike = static::searchLookalike($string);
            if ($lookalike === null) {
                throw new InvalidEnumValue();
            }
            $lookalikes[$string] = $lookalike;
        }

        return $lookalikes[$string];
    }

    /**
     * @param string $string
     * @return static|null
     */
    final protected static function searchLookalike(string $string)
    {
        $string = self::sanitize($string);
        foreach (static::ENUM as $enum) {
            if (self::sanitize($enum) === $string) {
                return static::fromString($enum);
            }
        }

        return null;
    }

    /**
     * @param string $string
     * @return string
     */
    final protected static function sanitize(string $string): string
    {
        $string = str_replace(['-', '_', ' '], '', $string);
        $string = strtolower($string);

        return $string;
    }

    /**
     * @param string $name
     * @return \Error
     */
    final protected static function undefinedMethod(string $name): \Error
    {
        return new \Error(sprintf('Call to undefined method %s::%s()', static::class, $name));
    }

}
