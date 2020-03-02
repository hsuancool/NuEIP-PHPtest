<?php

namespace App\Exceptions;

class CreateAccountInfoFailedException extends \InvalidArgumentException
{
    /**
     * AccountInfoNotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        if (!$message) {
            $message = "Create account failed.";
        }

        parent::__construct($message);
    }
}
