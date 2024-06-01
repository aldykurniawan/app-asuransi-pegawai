<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\Validator;

class CustomException extends Exception
{
    protected $data;

    protected $message;

    protected $errorCode;

    public function __construct($e, $baseMessage, $customMessage = null, $customErrorCode = null)
    {
        if ($e) {
            $validator = $e instanceof Validator ? $e : (isset($e->validator) ? $e->validator : null);
            if ($validator) {
                $this->message   = $baseMessage.'_VALIDATOR';
                $this->data      = ['errors' => $validator->errors()];
                $this->errorCode = 422;
            } else {
                $this->message = $customMessage ?? $baseMessage.'_ACTION';
                $this->data    = [
                    'errors' => [
                        'message' => [
                            $e->getMessage(),
                        ],
                    ],
                ];
                $this->errorCode = $customErrorCode ?? 400;
            }
        } else {
            $this->message   = $baseMessage;
            $this->errorCode = $customErrorCode ?? 400;
        }
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'code'    => $code,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function render($request)
    {
        return $this->sendError($this->message, ['error' => [
            'validator' => $this->data['errors'],
        ]], $this->errorCode);
    }
}
