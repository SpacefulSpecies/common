<?php

namespace Species\Common\Value\Uuid;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\Uuid\Mock\Uuid1Mock;

final class Uuid1ValueTest extends TestCase
{

    public function validUuidProvider()
    {
        return [
            [UuidFactory::v1()],
        ];
    }

    public function invalidUuidProvider()
    {
        $ns = UuidFactory::v1();
        $name = 'foo';

        return [
            [''],
            [UuidFactory::v1() . ' '],
            ['x' . UuidFactory::v1()],
            [UuidFactory::nil()],
            [UuidFactory::v3($ns, $name)],
            [UuidFactory::v4()],
            [UuidFactory::v5($ns, $name)],
        ];
    }



    /**
     * @dataProvider validUuidProvider
     * @test
     * @param string $validUuid
     */
    public function it_should_construct_from_any_uuid(string $validUuid)
    {
        $this->assertSame($validUuid, (string)Uuid1Mock::fromString($validUuid));
    }

    /**
     * @dataProvider invalidUuidProvider
     * @test
     * @param string $invalidUuid
     */
    public function it_should_validate_uuid(string $invalidUuid)
    {
        $this->expectException(InvalidUuid::class);
        Uuid1Mock::fromString($invalidUuid);
    }

}
