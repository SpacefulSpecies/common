<?php

namespace Species\Common\Value\Password\Exception;

/**
 * Exception thrown when an invalid plain password is given,
 *   eg: password not long enough or spaces not allowed.
 */
final class InvalidPassword extends \InvalidArgumentException
{

}
