<?php

namespace Species\Common\Value\Enum\Mock;

use Species\Common\Value\Enum\MagicEnumValue;

/**
 * @method static static foo()
 * @method static static Bar()
 * @method static static fooBar()
 *
 * @method bool isFoo()
 * @method bool inBar()
 * @method bool isFooBar()
 */
final class MagicEnumMock extends MagicEnumValue
{

    const ENUM = ['foo', 'bar', 'foo-bar'];

}
