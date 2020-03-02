<?php

namespace App\Http\Controllers\User;

use App\Exceptions\ParameterBagValidationException;
use App\Http\Controllers\Controller;
use App\ParameterBag\CreateAccountInfoParameterBag;
use App\Services\AccountInfoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        if (!$account) {
            return $this->responseFailedJsonWithFormat(Response::HTTP_NOT_FOUND, 'Account not found');
        }

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // TODO: update account
    }
}