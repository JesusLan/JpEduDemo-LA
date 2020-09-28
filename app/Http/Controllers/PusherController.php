<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Events\PublicMessageEvent;
use App\Events\PrivateMessageEvent;
use AppUser;

class PusherController extends Controller {

    public function publicPush()
    {
        $input = Input::all();
//        return $input['message'];
        event(new PublicMessageEvent($input['message']));
    }



    //私有消息
    public function privatePush()
    {
        $input = Input::all();

        $user = User::find($input['id']);
        if (empty($user)) return '无此用户';

        broadcast(new PrivateMessageEvent($user, $input['message']));
    }

}
