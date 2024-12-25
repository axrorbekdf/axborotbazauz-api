<?php

use Illuminate\Support\Facades\Validator;

if (!function_exists('successResponse')) {
    function successResponse($data)
    { 
        return [
            'status' => true,
            'result' => $data
        ];
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse($message)
    {
        if (is_array($message)) $message = getErrorMessageFromResponse($message);

        return [
            'status' => false,
            'error' => [
                'message' => $message
            ]
        ];
    }
}

if (!function_exists('validate')) {
    function validate(array $params, array $rules)
    {
        $validate = Validator::make($params, $rules);

        if ($validate->fails()) {
            return validationError($validate);
        }

        return true;
    }
}

if (!function_exists('validationError')) {
    function validationError($validation)
    {
        return [
            'status' => false,
            'error' => [
                'message' => $validation->errors()
            ]
        ];
    }
}

if (!function_exists('authFailed')) {
    function authFailed()
    {
        return [
            'status' => false,
            'error' => [
                'message' => "Authorization failed!"
            ]
        ];
    }
}

if (!function_exists('getErrorMessageFromResponse')) {
    function getErrorMessageFromResponse(array $response): string
    {
        # initial set default info message
        $message = "Undefined error: " . json_encode($response);

        # find error message
        if (isset($response['error'])) {
            if (isset($response['error']['message'])) {
                if (is_array($response['error']['message'])) $message = array_shift($response['error']['message']);
                else $message = $response['error']['message'];
            }
        }
        return $message;
    }
}
