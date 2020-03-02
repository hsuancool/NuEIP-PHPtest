<?php

namespace App\Exceptions;

use App\Helper\ResponseFormatHelper;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        DB::rollBack();

        switch (true) {
            case $exception instanceof AccountInfoNotFoundException:
                return ResponseFormatHelper::responseFailedJson(Response::HTTP_NOT_FOUND, $exception->getMessage());
            case $exception instanceof CreateAccountInfoFailedException:
                return ResponseFormatHelper::responseFailedJson(Response::HTTP_BAD_REQUEST, $exception->getMessage());
            case $exception instanceof ParameterBagValidationException:
                return ResponseFormatHelper::responseFailedJson(Response::HTTP_BAD_REQUEST, $exception->getMessage());
            default:
                return parent::render($request, $exception);
        }
    }
}
