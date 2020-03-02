<?php

namespace App\Exceptions;

class DeleteAccountInfoFailedException extends \InvalidArgumentException
{
    /**
     * DeleteAccountInfoFailedException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        if (!$message) {
            $message = "Delete account failed.";
        }

        parent::__construct($message);
    }
}
