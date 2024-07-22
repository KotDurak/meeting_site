<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->input('message', '');
        $user = Auth::user();

        if (!empty($message)) {
            broadcast(new MessageSend($message, $user))->toOthers();
        }

        return [
            'code'    => 0,
            'message' => 'OK',
        ];
    }
}
