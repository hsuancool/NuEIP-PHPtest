<?php

namespace App\Helper;

class ResponseFormatHelper
{
    public static function responseSuccessJson(array $data, $status = 200)
    {
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        $result = [
            'status' => $status,
            'data' => $data
        ];

        return response()->json($result, $status, $headers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public static function responseFailedJson($status, $message)
    {
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        $result = [
            'status' => $status,
            'message' => $message
        ];

        return response()->json($result, $status, $headers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}