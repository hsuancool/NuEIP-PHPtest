<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\CreateAccountInfoParameterBag;

class AccountInfoRepository implements AccountInfoRepositoryInterface
{
    protected $account_info;

    public function __construct(AccountInfo $account_info)
    {
        $this->account_info = $account_info;
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
        $account->account = $parameters->getAccount();
        $account->name = $parameters->getName();
        $account->gender = $parameters->getGender();
        $account->birth = $parameters->getBirth();
        $account->email = $parameters->getEmail();
        $account->message = $parameters->getMessage();
        $account->save();

        return $account;
    }
}