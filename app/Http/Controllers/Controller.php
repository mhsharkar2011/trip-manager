<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $http_status_code = HttpResponse::HTTP_OK;  //default
    //Check vendor\symfony\http-foundation\Response.php for all HTTP status codes

    const ERROR_CODE_INVALID_CRDENTIALS = 'INVALID_CRDENTIALS';
    const ERROR_CODE_VALIDATION_FAILED = 'VALIDATION_FAILED';

    protected function statusCode($code)
    {
        $this->http_status_code = $code;
        return $this;
    }

    protected function respond($data = [], $message = '', $headers = [], $status_code = null)
    {
        $data = is_array($data)? $data : compact('data');

        $response_array = array_merge([
            'status' => 'OK',
            'message' => $message
        ], $data);

        return response()->json($response_array, $status_code ?: $this->http_status_code, $headers);
    }

    protected function respondCreated($data = [], $message = 'Resource was created', $headers = [], $status_code = null) {
        return $this->respond($data, $message, [], HttpResponse::HTTP_CREATED);
    }

    protected function respondDeleted($data = [], $message = 'Resource was deleted', $headers = [], $status_code = null) {
        return $this->respond($data, $message); //not using HttpResponse::HTTP_NO_CONTENT (204) because in that cannot send any message
    }

    protected function respondNotFound($msg = 'The resource/data you are looking was not found', $data = [], $headers = [])
    {
        return $this
          ->statusCode(HttpResponse::HTTP_NOT_FOUND)
          ->respondError($msg, 'RESOURCE_NOT_FOUND', $data, $headers, HttpResponse::HTTP_NOT_FOUND);
    }

    protected function respondError($message, $error_code = 'ERROR', $data = [], $headers = [], $status_code = 500)
    {
        return $this
          ->statusCode($status_code)
          ->respond([
                'status' => 'ERROR',
                'error_code' => $error_code,
                'message' => $message,
                'errors' => $data
            ], $headers);
    }

    protected function respondValidationError($data = [], $message = 'There are validation errors', $headers = [])
    {
        return $this
          ->respondError($message, self::ERROR_CODE_VALIDATION_FAILED, $data, $headers, HttpResponse::HTTP_BAD_REQUEST);
    }

    protected function respondForbidden($msg = 'This action is not allowed for your access level', $data = [], $headers = [])
    {
        return $this
          ->statusCode(HttpResponse::HTTP_FORBIDDEN)
          ->respondError($msg, 'FORBIDDEN', $data, $headers, HttpResponse::HTTP_FORBIDDEN);
    }
    
}
