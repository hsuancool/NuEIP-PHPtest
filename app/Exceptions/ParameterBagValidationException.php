<?php

namespace App\Exceptions;

class ParameterBagValidationException extends \InvalidArgumentException
{
    /**
     * ParameterBagValidationException constructor.
     *
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        if (empty($errors)) {
            $message = "Invalid parameter(s)";
        } else {
            $message = json_encode($errors);
        }

        parent::__construct($message);
    }
}
