<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function index()
    {
        //return view('chat');
        return view('welcome');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message));

        return ['status' => 'Message Sent!'];
    }

    public function test()
    {
        $message = Message::first();
        $user = User::first();
        //dd( $message );
        
        broadcast(new MessageSent($user, $message, 'chat'));
    }
    
}
