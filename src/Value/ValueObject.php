<?php

namespace Species\Common\Value;

/**
 * Value object interface.
 */
interface ValueObject extends \JsonSerializable
{

    /**
     * Strict comparison.
     *
     * @param mixed $other
     * @return bool
     */
    public function sameAs($other): bool;

    /**
     * Loose comparison.
     *
     * @param mixed $other
     * @return bool
     */
    public function equals($other): bool;

}
