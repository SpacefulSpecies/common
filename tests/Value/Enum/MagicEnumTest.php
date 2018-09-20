<?php

namespace Species\Common\Value\Enum;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Enum\Mock\MagicEnumMock;

final class MagicEnumTest extends TestCase
{

    /** @test */
    public function it_should_construct_from_magic_factory_methods()
    {
        $this->assertSame('foo', (string)MagicEnumMock::foo());
        $this->assertSame('bar', (string)MagicEnumMock::Bar());
        $this->assertSame('foo-bar', (string)MagicEnumMock::fooBar());
    }

    /** @test */
    public function it_should_test_from_magic_methods()
    {
        $this->assertFalse(MagicEnumMock::foo()->isFooBar());

        $this->assertTrue(MagicEnumMock::foo()->isFoo());
        $this->assertTrue(MagicEnumMock::Bar()->inBar());
        $this->assertTrue(MagicEnumMock::fooBar()->isFooBar());
    }

}
