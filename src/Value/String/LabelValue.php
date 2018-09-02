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
    final protected function sanitizeValue(string $string): string
    {
        // replace all extra whitespaces, tabs and newlines with just one space.
        $string = preg_replace('/\s+/S', ' ', $string);

        return trim($string);
    }

}
