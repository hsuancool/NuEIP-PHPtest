<?php

namespace App\ParameterBag;

use Illuminate\Http\Request;

class AccountInfoParameterBag extends BaseParameterBag
{
    /**
     * AccountInfoParameterBag constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->setKeys(AccountInfoParam::getValues());

        parent::__construct($parameters);
    }

    public static function createFromArray(array $data)
    {
        return new static($data);
    }

    public static function createFromRequest(Request $request)
    {
        return new static($request->all());
    }

    protected function rules()
    {
    }

    protected function rulesForBatchDelete()
    {
        return [
            AccountInfoParam::ACCOUNT_IDS => 'required|array'
        ];
    }

    public function validateBatchDelete()
    {
        $this->validate($this->rulesForBatchDelete());
    }
}