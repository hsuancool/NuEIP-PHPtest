<?php

namespace App\ParameterBag;

use MabeEnum\Enum;

class AccountInfoParam extends Enum
{
    const ACCOUNT_IDS = 'accountIds';
    const ACCOUNT = 'account';
    const NAME = 'name';
    const GENDER = 'gender';
    const BIRTH = 'birth';
    const EMAIL = 'email';
    const MESSAGE = 'message';
}
