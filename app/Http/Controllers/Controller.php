<?php

namespace App\Http\Controllers;

use App\Helper\ResponseFormatHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseSuccessJsonWithFormat(array $data)
    {
        return ResponseFormatHelper::responseSuccessJson($data, Response::HTTP_OK);
    }

    protected function responseFailedJsonWithFormat($status, $message)
    {
        return ResponseFormatHelper::responseFailedJson($status, $message);
    }
}
