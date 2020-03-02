<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\AccountInfoParam;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\ParameterBag\UpdateAccountInfoParameterBag;

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

    /**
     * Update account info by parameters
     *
     * @param AccountInfo $account
     * @param UpdateAccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function updateByParameters(AccountInfo $account, UpdateAccountInfoParameterBag $parameters)
    {
        if ($parameters->has(AccountInfoParam::NAME)) {
            $account->name = $parameters->get(AccountInfoParam::NAME);
        }
        if ($parameters->has(AccountInfoParam::GENDER)) {
            $account->gender = $parameters->get(AccountInfoParam::GENDER);
        }
        if ($parameters->has(AccountInfoParam::BIRTH)) {
            $account->birth = $parameters->get(AccountInfoParam::BIRTH);
        }
        if ($parameters->has(AccountInfoParam::EMAIL)) {
            $account->email = $parameters->get(AccountInfoParam::EMAIL);
        }
        if ($parameters->has(AccountInfoParam::MESSAGE)) {
            $account->message = $parameters->get(AccountInfoParam::MESSAGE);
        }

        $account->save();

        return $account;
    }
}