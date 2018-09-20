<?php

namespace Species\Common\Value\Uuid;

/**
 * UUID validator.
 */
final class UuidValidator
{

    const NIL = '00000000-0000-0000-0000-000000000000';

    const PATTERN_V_1 = '/^[0-9a-f]{8}-[0-9a-f]{4}-1[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/D';
    const PATTERN_V_3 = '/^[0-9a-f]{8}-[0-9a-f]{4}-3[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/D';
    const PATTERN_V_4 = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/D';
    const PATTERN_V_5 = '/^[0-9a-f]{8}-[0-9a-f]{4}-5[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/D';
    const PATTERN_ANY = '/^[0-9a-f]{8}-[0-9a-f]{4}-[1345][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/D';



    /**
     * Static only.
     */
    private function __construct()
    {
    }



    /**
     * @param string $uuid
     * @return bool
     */
    public static function isUuid(string $uuid): bool
    {
        return $uuid === self::NIL
            || preg_match(self::PATTERN_ANY, $uuid) === 1;
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public static function isNil(string $uuid): bool
    {
        return $uuid === self::NIL;
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public static function isUuid1(string $uuid): bool
    {
        return (bool)preg_match(self::PATTERN_V_1, $uuid);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public static function isUuid3(string $uuid): bool
    {
        return (bool)preg_match(self::PATTERN_V_3, $uuid);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public static function isUuid4(string $uuid): bool
    {
        return (bool)preg_match(self::PATTERN_V_4, $uuid);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public static function isUuid5(string $uuid): bool
    {
        return (bool)preg_match(self::PATTERN_V_5, $uuid);
    }

}
