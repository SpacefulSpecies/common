<?php

namespace Species\Common\Value\Uuid\Mock;

use Species\Common\Value\Uuid\UuidFactory;
use Species\Common\Value\Uuid\UuidValue;

final class UuidMock extends UuidValue
{

    public static function generate()
    {
        return new static(UuidFactory::v4());
    }

}
