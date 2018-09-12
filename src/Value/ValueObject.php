<?php

namespace Species\Common\Value;

/**
 * Value object interface.
 */
interface ValueObject extends \JsonSerializable
{

    /**
     * @param mixed $other
     * @return bool
     */
    public function isSame($other): bool;

    /**
     * @param mixed $other
     * @return bool
     */
    public function equals($other): bool;

}
