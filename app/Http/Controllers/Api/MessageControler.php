<?php

namespace App\Http\Controllers\Api;

use App\Events\ChatDirectMessageEvent;
use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Traits\HttpResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageControler extends Controller
{
        use HttpResponseJson;

    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {

            return $this->responseJson(false,null,$validator->errors()->first());
        }


        broadcast(new ChatEvent($request->message))->toOthers();

        return $this->responseJson(true,null,'Message Successfully Sent');

    }


    public function sendDirectMessage(Request $request)
    {
        $data = $request->only(['message', 'authUserId']);
        broadcast(new ChatDirectMessageEvent($data))->toOthers();

        return $this->responseJson(true,$data,'Private Message Successfully Sent');

    }
}
