<?php

namespace App\ParameterBag;

use App\Exceptions\ParameterBagValidationException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Contracts\Validation\Factory;

abstract class BaseParameterBag extends ParameterBag
{
    /** @var array */
    protected $keys;

    /** @var Factory */
    protected $validator;

    /** @var MessageBag */
    protected $validate_errors;

    /**
     * BaseParameterBag constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->initValidator();

        parent::__construct($parameters);
    }

    public function isValid()
    {
        $validator = $this->validator->make($this->parameters, $this->rules());
        $this->validate_errors = $validator->errors();

        return !$validator->fails();
    }

    public function errors()
    {
        return $this->validate_errors->toArray();
    }

    public function validate()
    {
        if (!$this->isValid()) {
            throw new ParameterBagValidationException($this->errors());
        }
    }

    /**
     * @param array $keys
     */
    protected function setKeys(array $keys)
    {
        $this->keys = $keys;
    }

    protected function initValidator()
    {
        $this->validator = App::make(Factory::class);
    }

    /**
     * Define rules of each key
     *
     * @return array
     */
    abstract protected function rules();
}

