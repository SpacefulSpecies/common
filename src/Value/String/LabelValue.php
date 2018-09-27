<?php

namespace Species\Common\Value\String;

/**
 * Abstraction of a label value object.
 *
 * Only single space whitespace and trimmed.
 */
abstract class LabelValue extends StringValue
{

    /** @inheritdoc */
    public static function fromString(string $string)
    {
        $string = preg_replace('/\s+/S', ' ', $string);
        $string = trim($string, ' ');

        return parent::fromString($string);
    }

}
