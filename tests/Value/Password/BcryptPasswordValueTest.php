<?php

namespace Species\Common\Value\Password;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Password\Exception\InvalidPlainPassword;
use Species\Common\Value\Password\Exception\InvalidPasswordHash;
use Species\Common\Value\Password\Mock\BcryptMock;

final class BcryptPasswordValueTest extends TestCase
{

    const PASSWORD = 'my$3cr37P@55w0rd';
    const OTHER_PASSWORD = 'admin123';

    const VALID_HASH = '$2y$10$EMf0.qMpEIC7vKRjDZXC2uK52xoyZlnE/gNlh7h1K70NbfWE5CUzO';

    public function invalidHashProvider()
    {
        return [
            [''],
            ['my$3cr37P@55w0rd'],
            ['EMf0.qMpEIC7vKRjDZXC2uK52xoyZlnE/gNlh7h1K70NbfWE5CUzO'],
            ['$argon2i$v=19$m=1024,t=2,p=2$SmtJMU1iRWdKdXJQL3ZuOA$FixVlaYuQq52ysQD0dPTxR9o3TE+o42ffKOrlFMM1LA'],
        ];
    }



    /** @test */
    public function it_should_generate_and_verify_from_plain_password()
    {
        $password = BcryptMock::hash(self::PASSWORD);

        $this->assertTrue($password->verify(self::PASSWORD));
        $this->assertFalse($password->verify(self::OTHER_PASSWORD));
    }

    /** @test */
    public function it_should_create_from_hash()
    {
        $this->assertSame(self::VALID_HASH, (string)BcryptMock::fromString(self::VALID_HASH));
    }

    /**
     * @test
     * @dataProvider invalidHashProvider
     * @param $invalidHash
     */
    public function it_should_validate_hash($invalidHash)
    {
        $this->expectException(InvalidPasswordHash::class);
        BcryptMock::fromString($invalidHash);
    }

    /** @test */
    public function it_should_require_rehash_with_other_options()
    {
        $options = ['cost' => 10];
        $otherOptions = ['cost' => 11];

        $password = BcryptMock::hash(self::PASSWORD, $options);

        $this->assertTrue($password->needsRehash($otherOptions));
        $this->assertFalse($password->needsRehash($options));
    }

    /** @test */
    public function it_should_allow_super_long_passwords()
    {
        $longPassword = str_repeat(self::PASSWORD, 1000);
        $password = BcryptMock::hash($longPassword);

        $this->assertTrue($password->verify($longPassword));
        $this->assertFalse($password->verify($longPassword . 'x'));
    }

    /** @test */
    public function it_should_not_allow_passwords_smaller_than_6_by_default()
    {
        $this->expectException(InvalidPlainPassword::class);
        BcryptMock::hash('123');
    }

}
