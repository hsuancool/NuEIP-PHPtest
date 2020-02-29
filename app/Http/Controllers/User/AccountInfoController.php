<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\AccountInfoService;
use Illuminate\Http\Request;

class AccountInfoController extends Controller
{
    protected $account_info_service;

    public function __construct(AccountInfoService $account_info_service)
    {
        $this->account_info_service = $account_info_service;
    }

    public function show(string $account)
    {
        // TODO: show account info
    }

    public function list(Request $request)
    {
        $accounts = $this->account_info_service->getValidAccounts();

        return $this->responseSuccessJsonWithFormat($accounts);
    }

    public function create(Request $request)
    {
        // TODO: create account
    }

    public function update(Request $request)
    {
        // TODO: update account
    }
}