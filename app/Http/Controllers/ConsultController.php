<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoggerService;
use Validator;

class ConsultController extends Controller
{
    public function getLog(Request $request, LoggerService $service)
    {
        $logs = $service->getLog([], $request->query('sort'));

        if ($logs) {
            return response()->json($logs, 200);
        }

        $body = [
            'errCode' => 404,
            'errMsg' => 'Not Found'
        ];

        return response()->json($body, 404);
    }

    public function getSystemLog(Request $request, LoggerService $service, $system)
    {
        $inputs = [
            'system' => $system
        ];

        $validator = Validator::make($inputs, [
            'system' => 'required|alpha_num|exists:mongodb.systems,_id'
        ]);

        if ($validator->fails()) {
            $body = [
                'errCode' => 1,
                'errMsg' => $validator->errors()->first()
            ];

            return response()->json($body, 422);
        }

        $logs = $service->getLog([['system', $system]], $request->query('sort'));

        if ($logs) {
            return response()->json($logs, 200);
        }

        $body = [
            'errCode' => 404,
            'errMsg' => 'Not Found'
        ];

        return response()->json($body, 404);
    }


}
