<?php

namespace Species\Common\Value\String;

/**
 * Abstract label value object.
 *
 * Replaces all extra whitespace (newlines, tabs, multiple spaces, ...) into a single space
 * and trims the string.
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
