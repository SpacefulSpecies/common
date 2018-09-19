<?php

namespace Species\Common\Value\Password;

use Species\Common\Value\Password\Exception\InvalidPassword;
use Species\Common\Value\Password\Exception\InvalidPasswordHash;
use Species\Common\Value\String\StringValue;

/**
 * Abstract argon2i password value object.
 */
abstract class Argon2IPasswordValue extends StringValue implements PasswordValueObject
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



    /** @inheritdoc */
    final public static function generate(string $plainPassword, array $options = [])
    {
        static::guardPlainPassword($plainPassword);

        $hash = password_hash($plainPassword, PASSWORD_ARGON2I, [
            'memory_cost' => $options['memory_cost'] ?? PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => $options['time_cost'] ?? PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => $options['threads'] ?? PASSWORD_ARGON2_DEFAULT_THREADS,
        ]);

        return new static($hash);
    }



    /** @inheritdoc */
    final public static function fromString(string $string)
    {
        if (password_get_info($string)['algo'] !== PASSWORD_ARGON2I) {
            throw new InvalidPasswordHash();
        }

        return new static($string);
    }



    /** @inheritdoc */
    final public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->toString());
    }

    /** @inheritdoc */
    final public function needsRehash(array $options = []): bool
    {
        return password_needs_rehash($this->toString(), PASSWORD_ARGON2I, [
            'memory_cost' => $options['memory_cost'] ?? PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => $options['time_cost'] ?? PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => $options['threads'] ?? PASSWORD_ARGON2_DEFAULT_THREADS,
        ]);
    }

}
