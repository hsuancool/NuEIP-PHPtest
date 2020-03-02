<?php

namespace App\Services;

use App\Exceptions\AccountInfoNotFoundException;
use App\Exceptions\CreateAccountInfoFailedException;
use App\Exceptions\UpdateAccountInfoFailedException;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\ParameterBag\UpdateAccountInfoParameterBag;
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
     * Get valid account by id
     *
     * @return array
     */
    public function getValidAccountById(int $id)
    {
        if (!$account = $this->account_info_repo->getValidOneById($id)) {
            throw new AccountInfoNotFoundException();
        }

        return $account->toArray();
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
            throw new CreateAccountInfoFailedException();
        }

        return $account;
    }

    /**
     * Update account by UpdateAccountInfoParameterBag
     *
     * @param int $account_id
     * @param UpdateAccountInfoParameterBag $parameters
     * @return array
     */
    public function updateAccountByParameters(int $account_id, UpdateAccountInfoParameterBag $parameters)
    {
        if (!$account_info = $this->account_info_repo->getValidOneById($account_id)) {
            throw new AccountInfoNotFoundException();
        }

        try {
            $account = $this->account_info_repo->updateByParameters($account_info, $parameters)->toArray();
        } catch (QueryException $e) {
            throw new UpdateAccountInfoFailedException($e->getMessage());
        }

        return $account;
    }

    /**
     * @param int $account_id
     */
    public function deleteValidById(int $account_id)
    {
        if (!$account_info = $this->account_info_repo->getValidOneById($account_id)) {
            throw new AccountInfoNotFoundException();
        }

        try {
            $this->account_info_repo->delete($account_info);
        } catch (QueryException $e) {
            throw new UpdateAccountInfoFailedException($e->getMessage());
        }
    }
}