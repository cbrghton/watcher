<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoggerService;
use Validator;

class RegisterController extends Controller
{
    private $rules = [
        'system' => [
            'required',
            'alpha_num',
            'exists:mongodb.systems,_id'
        ],
        'type' => 'required|alpha',
        'log' => 'required'
    ];

    public function __invoke(Request $request, LoggerService $service)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $error_response = [
                'errCode' => 1,
                'errMsg' => $validator->errors()->first()
            ];

            return response()->json($error_response, 422);
        }

        $log = $service->insertLog($request->all());

        if ($log) {
            $response = [
                'errCode' => 0,
                'errMsg' => 'OK'
            ];

            return response()->json($response, 200);
        }

        $error_response = [
            'errCode' => 2,
            'errMsg' => 'Error when save data'
        ];

        return response()->json($error_response, 500);
    }
}
