<?php

namespace Species\Common\Value\Password;

use Species\Common\Value\Password\Exception\InvalidPassword;
use Species\Common\Value\Password\Exception\InvalidPasswordHash;
use Species\Common\Value\String\StringValue;

/**
 * Abstract bcrypt password value object.
 */
abstract class BcryptPasswordValue extends StringValue
{

    /**
     * @param string $plainPassword
     * @throws InvalidPassword
     */
    protected static function guardPassword(string $plainPassword): void
    {
        //
        if (strlen($plainPassword) < 6) {
            throw new InvalidPassword();
        }
    }



    /**
     * @param string $plainPassword
     * @param int    $cost = PASSWORD_BCRYPT_DEFAULT_COST
     * @return static
     */
    final public static function generate(string $plainPassword, int $cost = PASSWORD_BCRYPT_DEFAULT_COST)
    {
        static::guardPassword($plainPassword);

        $hash = self::preHash($plainPassword);
        $hash = password_hash($hash, PASSWORD_BCRYPT, ['cost' => $cost]);

        return new static($hash);
    }

    /**
     * To fix bcrypt 72 byte password limit.
     *
     * @param string $plainPassword
     * @return string
     */
    final private static function preHash(string $plainPassword): string
    {
        return base64_encode(hash('sha512', $plainPassword, true));
    }



    /** @inheritdoc */
    final protected function guardValue(string $value): void
    {
        if (password_get_info($value)['algo'] !== PASSWORD_BCRYPT) {
            throw new InvalidPasswordHash();
        }
    }



    /**
     * @param string $plainPassword
     * @return bool
     */
    final public function verify(string $plainPassword): bool
    {
        return password_verify(self::preHash($plainPassword), $this->toString());
    }

    /**
     * @param int $cost = PASSWORD_BCRYPT_DEFAULT_COST
     * @return bool
     */
    final public function needsRehash(int $cost = PASSWORD_BCRYPT_DEFAULT_COST): bool
    {
        return password_needs_rehash($this->toString(), PASSWORD_BCRYPT, ['cost' => $cost]);
    }

}
