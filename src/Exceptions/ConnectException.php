<?php

namespace Plugrbase\TwitterApi\Exceptions;

use Exception;

class ConnectException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Impossible to connect.');
    }
}
