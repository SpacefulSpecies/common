<?php

namespace Species\Common\Value\Enum\Mock;

use Species\Common\Value\Enum\MagicEnum;

/**
 * @method static static foo()
 * @method static static Bar()
 * @method static static fooBar()
 *
 * @method bool isFoo()
 * @method bool inBar()
 * @method bool isFooBar()
 */
final class MagicEnumMock extends MagicEnum
{

    const ENUM = ['foo', 'bar', 'foo-bar'];

}
