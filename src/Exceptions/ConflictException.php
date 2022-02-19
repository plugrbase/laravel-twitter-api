<?php

namespace Plugrbase\TwitterApi\Exceptions;

use Exception;

class ConflictException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('There is a conflict with current state of the target resource.');
    }
}
