<?php

namespace App\Exceptions;

class UpdateAccountInfoFailedException extends \InvalidArgumentException
{
    /**
     * UpdateAccountInfoFailedException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        if (!$message) {
            $message = "Update account failed.";
        }

        parent::__construct($message);
    }
}
