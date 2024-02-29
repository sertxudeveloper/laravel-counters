<?php

namespace SertxuDeveloper\Counters\Exceptions;

class MinimumValueException extends \Exception
{
    protected $message = 'Decrementing the counter would result in a negative value.';
}
