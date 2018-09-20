<?php

namespace Species\Common\Value\Uuid;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\Uuid\Mock\UuidMock;

final class UuidValueTest extends TestCase
{

    public function validUuidProvider()
    {
        $ns = UuidFactory::v4();
        $name = 'foo';

        return [
            [UuidFactory::nil()],
            [UuidFactory::v1()],
            [UuidFactory::v3($ns, $name)],
            [UuidFactory::v4()],
            [UuidFactory::v5($ns, $name)],
        ];
    }

    public function invalidUuidProvider()
    {
        return [
            [''],
            [UuidFactory::v1() . ' '],
            ['x' . UuidFactory::v4()],
        ];
    }



    /**
     * @dataProvider validUuidProvider
     * @test
     * @param string $validUuid
     */
    public function it_should_construct_from_any_uuid(string $validUuid)
    {
        $this->assertSame($validUuid, (string)UuidMock::fromString($validUuid));
    }

    /**
     * @dataProvider invalidUuidProvider
     * @test
     * @param string $invalidUuid
     */
    public function it_should_validate_uuid(string $invalidUuid)
    {
        $this->expectException(InvalidUuid::class);
        UuidMock::fromString($invalidUuid);
    }

}
