<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseSuccess($message, $data)
    {
        return response()->json([
            "status" => true,
            "message" => $message,
            "data" => $data
        ], 200);
    }

    protected function responseError($error, $message)
    {
        return response()->json([
            "status" => false,
            "error" => $error,
            "message" => $message
        ], 200);
    }

    public function inTime(){
        return new \DateTime('09:00:00');
    }

    public function outTime(){
        return new \DateTime('17:00:00');
    }
}
