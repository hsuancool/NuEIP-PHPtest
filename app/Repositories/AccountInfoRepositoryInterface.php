<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\CreateAccountInfoParameterBag;

interface AccountInfoRepositoryInterface
{
    public function getValid();

    /**
     * @param CreateAccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function createByParameters(CreateAccountInfoParameterBag $parameters);
}