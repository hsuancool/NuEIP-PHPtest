<?php

namespace App\Exceptions;

class AccountInfoNotFoundException extends \InvalidArgumentException
{
    /**
     * AccountInfoNotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        if (!$message) {
            $message = "Account not found";
        }

        parent::__construct($message);
    }
}
