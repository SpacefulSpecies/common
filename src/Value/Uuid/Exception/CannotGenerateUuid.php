<?php

namespace Species\Common\Value\Uuid\Exception;

/**
 * Exception thrown when an UUID cannot be generated.
 */
final class CannotGenerateUuid extends \LogicException
{

    /**
     * @param \Throwable $reason
     * @return CannotGenerateUuid
     */
    public static function withReason(\Throwable $reason): CannotGenerateUuid
    {
        return new self('', 0, $reason);
    }

}
