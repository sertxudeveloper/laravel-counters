<?php

namespace SertxuDeveloper\Counters;

class MinimumValueException extends \Exception
{
    protected $message = 'Decrementing the counter would result in a negative value.';
}
