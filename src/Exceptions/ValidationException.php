<?php

namespace Plugrbase\TwitterApi\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * The errors.
     */
    public array $errors;

    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(array $errors)
    {
        parent::__construct('Validation of data has failed.');

        $this->errors = $errors;
    }

    /**
     * Return the errors.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
}
