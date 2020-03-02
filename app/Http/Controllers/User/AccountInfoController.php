<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\ParameterBag\UpdateAccountInfoParameterBag;
use App\Services\AccountInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountInfoController extends Controller
{
    protected $account_info_service;

    /**
     * AccountInfoController constructor.
     * @param AccountInfoService $account_info_service
     */
    public function __construct(AccountInfoService $account_info_service)
    {
        $this->account_info_service = $account_info_service;
    }

    /**
     * Show account info by account
     *
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $account_id)
    {
        $account = $this->account_info_service->getValidAccountById($account_id);

        return $this->responseSuccessJsonWithFormat($account);
    }

    /**
     * List valid account info
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $accounts = $this->account_info_service->getValidAccounts();

        return $this->responseSuccessJsonWithFormat($accounts);
    }

    /**
     * Create account info
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(Request $request)
    {
        DB::beginTransaction();

        $parameters = CreateAccountInfoParameterBag::createFromRequest($request);
        $parameters->validate();

        $account = $this->account_info_service->createAccountByParameters($parameters);

        DB::commit();

        return $this->responseSuccessJsonWithFormat($account);
    }

    /**
     * Update account info
     *
     * @param int $account_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $account_id, Request $request)
    {
        DB::beginTransaction();

        $parameters = UpdateAccountInfoParameterBag::createFromRequest($request);
        $parameters->validate();

        $account = $this->account_info_service->updateAccountByParameters($account_id, $parameters);

        DB::commit();

        return $this->responseSuccessJsonWithFormat($account);
    }

    /**
     * Delete account info by account id
     *
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $account_id)
    {
        DB::beginTransaction();

        $this->account_info_service->deleteValidById($account_id);

        DB::commit();

        return $this->responseSuccessJsonWithFormat([]);
    }
}