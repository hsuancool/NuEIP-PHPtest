<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\ParameterBag\AccountInfoParam;
use App\ParameterBag\AccountInfoParameterBag;

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
     * @param int $per_page
     * @return AccountInfo[]
     */
    public function getValid(int $per_page = 0)
    {
        $account = $this->account_info
            ->whereNull('deleted_at');

        if ($per_page) {
            return $account->paginate($per_page);
        }

        return $account->get();
    }

    /**
     * Create account info by parameters
     *
     * @param AccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function createByParameters(AccountInfoParameterBag $parameters)
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
     * @param AccountInfoParameterBag $parameters
     * @return AccountInfo
     */
    public function updateByParameters(AccountInfo $account, AccountInfoParameterBag $parameters)
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