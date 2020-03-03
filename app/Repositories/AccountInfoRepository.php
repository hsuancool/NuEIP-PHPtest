<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\AccountInfoParam;
use App\ParameterBag\AccountInfoParameterBag;
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
        $account_info = new AccountInfo();

        $account = strtolower($parameters->get(AccountInfoParam::ACCOUNT));
        $account_info->account = $account;
        $account_info->name = $parameters->get(AccountInfoParam::NAME);
        $account_info->gender = $parameters->get(AccountInfoParam::GENDER);
        $account_info->birth = $parameters->get(AccountInfoParam::BIRTH);
        $account_info->email = $parameters->get(AccountInfoParam::EMAIL);
        $account_info->message = $parameters->get(AccountInfoParam::MESSAGE);
        $account_info->save();

        return $account_info;
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

    /**
     * @param AccountInfo $account
     * @throws \Exception
     */
    public function delete(AccountInfo $account)
    {
        $account->delete();
    }

    /**
     * @param AccountInfoParameterBag $parameters
     * @throws \Exception
     */
    public function batchDeleteByParameters(AccountInfoParameterBag $parameters)
    {
        $this->account_info->whereIn('id', $parameters->get(AccountInfoParam::ACCOUNT_IDS))->delete();
    }
}