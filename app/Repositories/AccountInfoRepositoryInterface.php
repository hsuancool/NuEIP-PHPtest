<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\ParameterBag\UpdateAccountInfoParameterBag;

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

    /**
     * @param AccountInfo $account
     * @param UpdateAccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function updateByParameters(AccountInfo $account, UpdateAccountInfoParameterBag $parameters);

    /**
     * @param AccountInfo $account
     * @return void
     */
    public function delete(AccountInfo $account);
}