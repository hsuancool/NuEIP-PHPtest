<?php

namespace App\Services;

use App\Repositories\AccountInfoRepository;

class AccountInfoService
{
    protected $account_info_repo;

    public function __construct(AccountInfoRepository $account_info_repo)
    {
        $this->account_info_repo = $account_info_repo;
    }

    public function getValidAccounts()
    {
        return $this->account_info_repo->getValid()->toArray();
    }
}