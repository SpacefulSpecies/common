<?php

namespace Species\Common\Value\String;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\String\Mock\StringMock;

final class StringTest extends TestCase
{

    /** @test */
    public function it_should_cast_to_string()
    {
        $subject = StringMock::fromString('string');

        $this->assertSame('string', $subject->toString());
        $this->assertSame('string', $subject->__toString());
        $this->assertSame('string', "$subject");
        $this->assertSame('string', (string)$subject);

        $this->assertSame('-5.8', (string)StringMock::fromString(-5.8));
        $this->assertSame('1', (string)StringMock::fromString(true));
        $this->assertSame('', (string)StringMock::fromString(false));
    }

    /** @test */
    public function it_should_cast_to_json()
    {
        $subject = StringMock::fromString('string');

        $this->assertSame('"string"', json_encode($subject));
    }

    /** @test */
    public function it_should_compare_same_value_object()
    {
        $string = StringMock::fromString('string');

        $this->assertTrue($string->sameAs(StringMock::fromString('string')));

        $this->assertFalse($string->sameAs('string'));
        $this->assertFalse($string->sameAs(StringMock::fromString('STRING')));
        $this->assertFalse($string->sameAs(StringMock::fromString('other')));
    }

    /** @test */
    public function it_should_compare_equal_strings()
    {
        $string = StringMock::fromString('string');

        $this->assertTrue($string->equals(StringMock::fromString('string')));
        $this->assertTrue($string->equals('string'));

        $this->assertFalse($string->equals('STRING'));
        $this->assertFalse($string->equals(StringMock::fromString('STRING')));
        $this->assertFalse($string->equals(StringMock::fromString('other')));
    }

}
