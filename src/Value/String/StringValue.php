<?php

namespace Species\Common\Value\String;

/**
 * Abstraction of a string value object.
 */
abstract class StringValue implements StringValueObject
{

    /** @var string */
    private $string;



    /** @inheritdoc */
    public static function fromString(string $string)
    {
        return new static($string);
    }



    /**
     * @param string $string
     */
    final protected function __construct(string $string)
    {
        $this->string = $string;
    }



    /** @inheritdoc */
    final public function jsonSerialize(): string
    {
        return $this->string;
    }

    /** @inheritdoc */
    final public function __toString(): string
    {
        return $this->string;
    }

    /** @inheritdoc */
    final public function toString(): string
    {
        return $this->string;
    }



    /** @inheritdoc */
    final public function sameAs($other): bool
    {
        if (!$other instanceof static) {
            return false;
        }

        return $this->string === $other->string;
    }

    /** @inheritdoc */
    final public function equals($other): bool
    {
        if (!$other instanceof static) {
            try {
                $other = static::fromString($other);
            } catch (\Throwable $e) {
                return false;
            }
        }

        return $this->string === $other->string;
    }

}
