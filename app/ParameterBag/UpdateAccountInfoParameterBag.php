<?php

namespace App\ParameterBag;

use Illuminate\Http\Request;

/**
 * @method string getAccount()
 * @method string getName()
 * @method string getGender()
 * @method string getBirth()
 * @method string getEmail()
 * @method string getMessage()
 */
class UpdateAccountInfoParameterBag extends BaseParameterBag
{
    /**
     * UpdateAccountInfoParameterBag constructor.
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
        return [
            AccountInfoParam::NAME => 'string',
            AccountInfoParam::GENDER => 'in:0,1',
            AccountInfoParam::BIRTH => 'date',
            AccountInfoParam::EMAIL => 'email',
        ];
    }
}