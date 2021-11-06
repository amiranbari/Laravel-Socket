<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        broadcast(new ExampleEvent($request->message, auth()->user()));

        return response()->json([
            'status'     =>  200,
            'message'    =>  'Message Sent successfully.'
        ], 200);
    }

    public function chat()
    {
        return view('chat');
    }
}
