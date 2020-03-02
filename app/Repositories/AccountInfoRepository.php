<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\AccountInfoParam;
use App\ParameterBag\CreateAccountInfoParameterBag;

class AccountInfoRepository implements AccountInfoRepositoryInterface
{
    protected $account_info;

    public function __construct(AccountInfo $account_info)
    {
        $this->account_info = $account_info;
    }

    /**
     * Get valid account info by id
     *
     * @return AccountInfo
     */
    public function getValidOneById(int $id)
    {
        return $this->account_info
            ->find($id);
    }

    /**
     * Get valid account info
     *
     * @return AccountInfo[]
     */
    public function getValid()
    {
        return $this->account_info
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * Create account info by parameters
     *
     * @param CreateAccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function createByParameters(CreateAccountInfoParameterBag $parameters)
    {
        $account = new AccountInfo();
        $account->account = $parameters->get(AccountInfoParam::ACCOUNT);
        $account->name = $parameters->get(AccountInfoParam::NAME);
        $account->gender = $parameters->get(AccountInfoParam::GENDER);
        $account->birth = $parameters->get(AccountInfoParam::BIRTH);
        $account->email = $parameters->get(AccountInfoParam::EMAIL);
        $account->message = $parameters->get(AccountInfoParam::MESSAGE);
        $account->save();

        return $account;
    }
}