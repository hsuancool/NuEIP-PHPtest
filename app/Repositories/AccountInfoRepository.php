<?php

namespace App\Repositories;

use App\Models\AccountInfo;

class AccountInfoRepository implements AccountInfoRepositoryInterface
{
    protected $account_info;

    public function __construct(AccountInfo $account_info)
    {
        $this->account_info = $account_info;
    }

    public function getValid()
    {
        return $this->account_info
            ->whereNull('deleted_at')
            ->get();
    }
}