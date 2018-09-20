<?php

namespace Species\Common\Value\Uuid;

use Ramsey\Uuid\Uuid;
use Species\Common\Value\Uuid\Exception\CannotGenerateUuid;

/**
 * UUID factory.
 *
 * @see \Ramsey\Uuid\Uuid
 */
final class UuidFactory
{

    /**
     * Static only.
     */
    private function __construct()
    {
    }



    /**
     * @return string
     */
    public static function nil(): string
    {
        return UuidValidator::NIL;
    }

    /**
     * @param int|string|null $node     = null
     * @param int|null        $clockSeq = null
     * @return string
     * @see Uuid::uuid1()
     */
    public static function v1($node = null, $clockSeq = null): string
    {
        try {
            return Uuid::uuid1($node, $clockSeq)->toString();
        } catch (\Throwable $e) {
            throw CannotGenerateUuid::withReason($e);
        }
    }

    /**
     * @param string $ns
     * @param string $name
     * @return string
     * @see Uuid::uuid3()
     */
    public static function v3(string $ns, string $name): string
    {
        try {
            return Uuid::uuid3($ns, $name)->toString();
        } catch (\Throwable $e) {
            throw CannotGenerateUuid::withReason($e);
        }
    }

    /**
     * @return string
     * @see Uuid::uuid4()
     */
    public static function v4(): string
    {
        try {
            return Uuid::uuid4()->toString();
        } catch (\Throwable $e) {
            throw CannotGenerateUuid::withReason($e);
        }
    }

    /**
     * @param string $ns
     * @param string $name
     * @return string
     * @see Uuid::uuid5()
     */
    public static function v5(string $ns, string $name): string
    {
        try {
            return Uuid::uuid3($ns, $name)->toString();
        } catch (\Throwable $e) {
            throw CannotGenerateUuid::withReason($e);
        }
    }

}
