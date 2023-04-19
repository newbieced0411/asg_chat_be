<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages($id){
        // $messages = Message::where('user_id', auth()->id())->where('contact_id', $id)->get();
        $user = User::findOrFail($id);
        $messages = Message::where(function($query) use($id) {
            $query->where('user_id', auth()->id());
            $query->where('contact_id', $id);
        })->orWhere(function($query) use($id) {
            $query->where('user_id', $id);
            $query->where('contact_id', auth()->id());
        })
        ->with('user')
        ->get();
        
        return response()->json([
            'responder' => $user,
            'convo' => $messages
        ], 200);
    }

    public function send(Request $request)
    {
        $request->validation([
            'message'
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'contact_id' =>  $request->responder_id,
            'message' => $request->chat
        ]);

        return response()->json([
            'message' => 'Success'
        ], 201);
    }
}
