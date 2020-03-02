<?php

namespace App\Services;

use App\ParameterBag\CreateAccountInfoParameterBag;
use App\Repositories\AccountInfoRepositoryInterface;
use Illuminate\Database\QueryException;

class AccountInfoService
{
    protected $account_info_repo;

    public function __construct(AccountInfoRepositoryInterface $account_info_repo)
    {
        $this->account_info_repo = $account_info_repo;
    }

    /**
     * Get valid accounts
     *
     * @return array
     */
    public function getValidAccounts()
    {
        return $this->account_info_repo->getValid()->toArray();
    }

    /**
     * Create account by CreateAccountInfoParameterBag
     *
     * @param CreateAccountInfoParameterBag $parameters
     * @return array
     *
     * @throws \Exception
     */
    public function createAccountByParameters(CreateAccountInfoParameterBag $parameters)
    {
        try {
            $account = $this->account_info_repo->createByParameters($parameters)->toArray();
        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }

        return $account;
    }
}