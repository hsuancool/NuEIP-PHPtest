<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\CreateAccountInfoParameterBag;

interface AccountInfoRepositoryInterface
{
    /**
     * @param int $id
     * @return AccountInfo
     */
    public function getValidOneById(int $id);

    /**
     * @return AccountInfo[]
     */
    public function getValid();

    /**
     * @param CreateAccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function createByParameters(CreateAccountInfoParameterBag $parameters);
}