<?php

namespace Species\Common\Value\String;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\String\Mock\LabelMock;

final class LabelTest extends TestCase
{

    /** @test */
    public function it_should_remove_extra_whitespace()
    {
        // tab, new line, carriage return, form feed, vertical tab
        $this->assertSame('foo bar', (string)LabelMock::fromString("foo\t\n\r\f\x0Bbar"));

        $this->assertSame('foo bar', (string)LabelMock::fromString("\t\tfoo    \r\n \n\r \f bar\x0B"));
    }

    /** @test */
    public function it_should_trim_strings()
    {
        $this->assertSame('foo', (string)LabelMock::fromString(" \t  foo \r"));
    }

}
