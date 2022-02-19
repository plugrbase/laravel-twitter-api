<?php

namespace Plugrbase\TwitterApi\Exceptions;

use Exception;

class RequestException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct($e)
    {
        parent::__construct($e->message);
    }
}
