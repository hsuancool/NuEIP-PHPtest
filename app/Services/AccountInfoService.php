<?php

namespace App\Services;

use App\Exceptions\AccountInfoNotFoundException;
use App\Exceptions\CreateAccountInfoFailedException;
use App\Exceptions\UpdateAccountInfoFailedException;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\ParameterBag\UpdateAccountInfoParameterBag;
use App\Repositories\AccountInfoRepositoryInterface;
use App\Serializable\AccountInfoSerializer;
use Illuminate\Database\QueryException;

class AccountInfoService extends Service
{
    protected $account_info_repo;

    public function __construct(AccountInfoRepositoryInterface $account_info_repo)
    {
        parent::__construct();
        $this->account_info_repo = $account_info_repo;
    }

    /**
     * Get valid account by id
     *
     * @param int $id
     * @return array
     */
    public function getValidAccountById(int $id)
    {
        if (!$account = $this->account_info_repo->getValidOneById($id)) {
            throw new AccountInfoNotFoundException();
        }

        $groups = ['groups' => 'account-info'];
        return $this->serializer->normalize(new AccountInfoSerializer($account), null, $groups);
    }

    /**
     * Get valid accounts
     *
     * @return array
     */
    public function getValidAccounts()
    {
        $accounts = $this->account_info_repo->getValid();

        $groups = ['groups' => 'account-info'];
        $data['accounts'] = [];
        foreach ($accounts as $account) {
            $data['accounts'][] = $this->serializer->normalize(new AccountInfoSerializer($account), null, $groups);
        }

        return $data;
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
            $account = $this->account_info_repo->createByParameters($parameters);
        } catch (QueryException $e) {
            throw new CreateAccountInfoFailedException();
        }

        $groups = ['groups' => 'account-info'];
        return $this->serializer->normalize(new AccountInfoSerializer($account), null, $groups);
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
            $account = $this->account_info_repo->updateByParameters($account_info, $parameters);
        } catch (QueryException $e) {
            throw new UpdateAccountInfoFailedException($e->getMessage());
        }

        $groups = ['groups' => 'account-info'];
        return $this->serializer->normalize(new AccountInfoSerializer($account), null, $groups);
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