<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\AccountInfoParameterBag;

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
     * @param AccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function createByParameters(AccountInfoParameterBag $parameters);

    /**
     * @param AccountInfo $account
     * @param AccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function updateByParameters(AccountInfo $account, AccountInfoParameterBag $parameters);

    /**
     * @param AccountInfo $account
     * @return void
     */
    public function delete(AccountInfo $account);

    /**
     * @param AccountInfoParameterBag $parameters
     * @return void
     */
    public function batchDeleteByParameters(AccountInfoParameterBag $parameters);
}