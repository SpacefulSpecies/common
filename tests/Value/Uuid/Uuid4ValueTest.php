<?php

namespace Species\Common\Value\Uuid;

use PHPUnit\Framework\TestCase;
use Species\Common\Value\Uuid\Exception\InvalidUuid;
use Species\Common\Value\Uuid\Mock\Uuid4Mock;

final class Uuid4ValueTest extends TestCase
{

    public function validUuidProvider()
    {
        return [
            [UuidFactory::v4()],
        ];
    }

    public function invalidUuidProvider()
    {
        $ns = UuidFactory::v4();
        $name = 'foo';

        return [
            [''],
            [UuidFactory::v4() . ' '],
            ['x' . UuidFactory::v4()],
            [UuidFactory::nil()],
            [UuidFactory::v1()],
            [UuidFactory::v3($ns, $name)],
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
        $this->assertSame($validUuid, (string)Uuid4Mock::fromString($validUuid));
    }

    /**
     * @dataProvider invalidUuidProvider
     * @test
     * @param string $invalidUuid
     */
    public function it_should_validate_uuid(string $invalidUuid)
    {
        $this->expectException(InvalidUuid::class);
        Uuid4Mock::fromString($invalidUuid);
    }

}
