<?php
namespace App\Helpers;

use Auth;
use Session;
use Illuminate\Support\Facades\Http;

class ApiHelper{
    public static function apiResult($status,$code,$message,$data = null) {
        if($data) {
            return response()->json(['data' => $data,'status' => $status, 'code' => $code, 'message' => $message ]);
        }
        else {
            return response()->json(['data' =>[],'status' => $status, 'code' => $code, 'message' => $message ]);
        }
       
    }
}