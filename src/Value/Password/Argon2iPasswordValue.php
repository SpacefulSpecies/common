<?php

namespace Species\Common\Value\Password;

use Species\Common\Value\Password\Exception\InvalidPassword;
use Species\Common\Value\Password\Exception\InvalidPasswordHash;
use Species\Common\Value\String\StringValue;

/**
 * Abstract argon2i password value object.
 */
abstract class Argon2IPasswordValue extends StringValue
{

    /**
     * @param string $plainPassword
     * @throws InvalidPassword
     */
    protected static function guardPassword(string $plainPassword): void
    {
        if (strlen($plainPassword) < 6) {
            throw new InvalidPassword();
        }
    }



    /**
     * @param string $plainPassword
     * @param int    $memoryCost = PASSWORD_ARGON2_DEFAULT_MEMORY_COST
     * @param int    $timeCost   = PASSWORD_ARGON2_DEFAULT_TIME_COST
     * @param int    $threads    = PASSWORD_ARGON2_DEFAULT_THREADS
     * @return static
     */
    final public static function generate(
        string $plainPassword,
        int $memoryCost = PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
        int $timeCost = PASSWORD_ARGON2_DEFAULT_TIME_COST,
        int $threads = PASSWORD_ARGON2_DEFAULT_THREADS
    )
    {
        static::guardPassword($plainPassword);

        $hash = password_hash($plainPassword, PASSWORD_ARGON2I, [
            'memory_cost' => $memoryCost,
            'time_cost' => $timeCost,
            'threads' => $threads,
        ]);

        return new static($hash);
    }



    /** @inheritdoc */
    final protected function guardValue(string $value): void
    {
        if (password_get_info($value)['algo'] !== PASSWORD_ARGON2I) {
            throw new InvalidPasswordHash();
        }
    }



    /**
     * @param string $plainPassword
     * @return bool
     */
    final public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->toString());
    }

    /**
     * @param int $memoryCost = PASSWORD_ARGON2_DEFAULT_MEMORY_COST
     * @param int $timeCost   = PASSWORD_ARGON2_DEFAULT_TIME_COST
     * @param int $threads    = PASSWORD_ARGON2_DEFAULT_THREADS
     * @return bool
     */
    final public function needsRehash(
        int $memoryCost = PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
        int $timeCost = PASSWORD_ARGON2_DEFAULT_TIME_COST,
        int $threads = PASSWORD_ARGON2_DEFAULT_THREADS
    ): bool
    {
        return password_needs_rehash($this->toString(), PASSWORD_ARGON2I, [
            'memory_cost' => $memoryCost,
            'time_cost' => $timeCost,
            'threads' => $threads,
        ]);
    }

}
