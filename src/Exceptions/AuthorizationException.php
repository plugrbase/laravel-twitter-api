<?php

namespace Plugrbase\TwitterApi\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('You are not authorized to access this resource.');
    }
}
