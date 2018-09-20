<?php

namespace Species\Common\Value\Password;

use Species\Common\Value\Password\Exception\InvalidPassword;
use Species\Common\Value\Password\Exception\InvalidPasswordHash;
use Species\Common\Value\String\StringValue;

/**
 * Abstract bcrypt password value object.
 */
abstract class BcryptPasswordValue extends StringValue implements PasswordValueObject
{

    /**
     * Override this method to guard the plain password rules.
     *
     * @param string $plainPassword
     * @throws InvalidPassword
     */
    protected static function guardPlainPassword(string $plainPassword): void
    {
        if (strlen($plainPassword) < 6) {
            throw new InvalidPassword();
        }
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
    final public static function hash(string $plainPassword, array $options = [])
    {
        static::guardPlainPassword($plainPassword);

        $hash = self::preHash($plainPassword);
        $hash = password_hash($hash, PASSWORD_BCRYPT, [
            'cost' => $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST,
        ]);

        return new static($hash);
    }



    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (password_get_info($string)['algo'] !== PASSWORD_BCRYPT) {
            throw new InvalidPasswordHash();
        }

        return new static($string);
    }



    /** @inheritdoc */
    final public function verify(string $plainPassword): bool
    {
        return password_verify(self::preHash($plainPassword), $this->toString());
    }

    /** @inheritdoc */
    final public function needsRehash(array $options = []): bool
    {
        return password_needs_rehash($this->toString(), PASSWORD_BCRYPT, [
            'cost' => $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST,
        ]);
    }

}
