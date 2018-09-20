<?php

namespace Species\Common\Value\Password;

use Species\Common\Value\String\StringValueObject;

/**
 * Password value interface.
 */
interface PasswordValueObject extends StringValueObject
{

    /**
     * @param string $plainPassword
     * @param array  $options = []
     * @return static
     */
    public static function hash(string $plainPassword, array $options = []);



    /**
     * @param string $plainPassword
     * @return bool
     */
    public function verify(string $plainPassword): bool;

    /**
     * @param array $options
     * @return bool
     */
    public function needsRehash(array $options = []): bool;

}
