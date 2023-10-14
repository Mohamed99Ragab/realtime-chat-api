<?php

namespace App\Traits;

trait HttpResponseJson
{

    public function responseJson($success,$data=null, $message=null){

        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'success'=>$success
        ]);

    }
}
