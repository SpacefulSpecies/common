<?php

namespace Species\Common\Value\String;

/**
 * Abstraction of a string value object.
 */
abstract class StringValue implements \JsonSerializable
{

    /** @var string */
    private $string;



    /**
     * @param string $string
     * @return static
     */
    final public static function fromString(string $string)
    {
        return new static($string);
    }



    /**
     * @param string $string
     */
    final protected function __construct(string $string)
    {
        $string = $this->sanitizeValue($string);
        $this->guardValue($string);

        $this->string = $string;
    }



    /**
     * @param string $string
     * @return string
     */
    protected function sanitizeValue(string $string): string
    {
        return $string;
    }

    /**
     * @param string $string
     * @throws \InvalidArgumentException
     */
    protected function guardValue(string $string): void
    {
    }



    /**
     * @inheritdoc
     * @return string
     */
    final public function jsonSerialize(): string
    {
        return $this->string;
    }

    /**
     * @return string
     */
    final public function __toString(): string
    {
        return $this->string;
    }

    /**
     * @return string
     */
    final public function toString(): string
    {
        return $this->string;
    }



    /**
     * @param mixed $other
     * @return bool
     */
    final public function isSame($other): bool
    {
        if (!$other instanceof static) {
            return false;
        }

        return $this->string === $other->string;
    }

    /**
     * @param mixed $other
     * @return bool
     */
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
