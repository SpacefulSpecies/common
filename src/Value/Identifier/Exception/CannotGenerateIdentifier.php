<?php

namespace Species\Common\Value\Identifier\Exception;

/**
 * Exception thrown when an identifier cannot be generated.
 */
final class CannotGenerateIdentifier extends \LogicException
{

    /**
     * @param \Throwable $reason
     * @return CannotGenerateIdentifier
     */
    public static function withReason(\Throwable $reason): CannotGenerateIdentifier
    {
        return new self('', 0, $reason);
    }

}
