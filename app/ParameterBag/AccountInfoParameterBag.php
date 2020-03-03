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

    protected function rulesForCreate()
    {
        return [
            AccountInfoParam::ACCOUNT => 'required|regex:/[a-zA-Z0-9]/i',
            AccountInfoParam::NAME => 'required',
            AccountInfoParam::GENDER => 'required|in:0,1',
            AccountInfoParam::BIRTH => 'required|date',
            AccountInfoParam::EMAIL => 'required|email',
        ];
    }

    protected function rulesForUpdate()
    {
        return [
            AccountInfoParam::NAME => 'string',
            AccountInfoParam::GENDER => 'in:0,1',
            AccountInfoParam::BIRTH => 'date',
            AccountInfoParam::EMAIL => 'email',
        ];
    }

    protected function rulesForBatchDelete()
    {
        return [
            AccountInfoParam::ACCOUNT_IDS => 'required|array'
        ];
    }

    public function validateCreate()
    {
        $this->validate($this->rulesForCreate());
    }

    public function validateUpdate()
    {
        $this->validate($this->rulesForUpdate());
    }

    public function validateBatchDelete()
    {
        $this->validate($this->rulesForBatchDelete());
    }
}