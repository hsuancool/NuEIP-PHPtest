<?php

namespace App\ParameterBag;

use App\Enum\AccountInfoParam;
use Illuminate\Http\Request;

/**
 * @method string getAccount()
 * @method string getName()
 * @method string getGender()
 * @method string getBirth()
 * @method string getEmail()
 * @method string getMessage()
 */
class CreateAccountInfoParameterBag extends BaseParameterBag
{
    /**
     * CreateAccountInfoParameterBag constructor.
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
            AccountInfoParam::ACCOUNT => 'required|regex:/[a-zA-Z0-9]/i',
            AccountInfoParam::NAME => 'required',
            AccountInfoParam::GENDER => 'required|in:F,M',
            AccountInfoParam::BIRTH => 'required|date',
            AccountInfoParam::EMAIL => 'required|email',
        ];
    }
}