<?php

namespace Species\Common\Value\Enum;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Enum\Exception\InvalidEnumValue;
use Species\Common\Value\Enum\Mock\EnumMock;

final class EnumTest extends TestCase
{

    /** @test */
    public function it_should_construct_from_string()
    {
        $this->assertSame('foo', (string)EnumMock::fromString('foo'));
        $this->assertSame('bar', (string)EnumMock::fromString('bar'));
    }

    /** @test */
    public function it_should_construct_from_index()
    {
        $this->assertSame('foo', (string)EnumMock::fromIndex(0));
        $this->assertSame('bar', (string)EnumMock::fromIndex(1));
    }

    /** @test */
    public function it_should_validate_string()
    {
        $this->expectException(InvalidEnumValue::class);
        EnumMock::fromString('baz');
    }

    /** @test */
    public function it_should_validate_index()
    {
        $this->expectException(InvalidEnumValue::class);
        EnumMock::fromIndex(2);
    }

    /** @test */
    public function it_should_have_enum_constant()
    {
        foreach (EnumMock::ENUM as $index => $string) {
            $enum = EnumMock::fromString($string);

            $this->assertSame($string, $enum->toString());
            $this->assertSame($index, $enum->getIndex());
        }
    }

    /** @test */
    public function it_should_have_singletons()
    {
        $foo = EnumMock::fromString('foo');

        $this->assertSame($foo, EnumMock::fromString('foo'));
        $this->assertSame($foo, EnumMock::getSingletons()['foo']);
    }

}
