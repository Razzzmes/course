<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public function store(MessageRequest $request, $post_id) {

        if(Auth::check()) {

            $topic = Topic::find($post_id);

            $message = Message::create([
                'message_body' => $request->message_body,
                'topic_id' => $topic->id,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'message' => 'message added',
                'message' => $message
            ]);
        }
    }

    public function update(MessageRequest $request, $id, $message) {


            $messages = Message::find($message);

            if((Auth::check() && (Auth::id() == $messages->user_id))) {

                $messages->update($request->all());

                return response()->json([
                    'message' => 'message updated',
                    'message' => $message
                ]);
            } else {
                return response()->json([
                    'message' => 'auth errors'
                ]);
            }

    }

    public function destroy($id, $message) {

        $messages = Message::find($message);

        if((Auth::check() && (Auth::id() == $messages->user_id))) {

            $messages->delete();

            return response()->json([
                'message' => 'message deleted',
                'message' => $message
            ]);
        } else {
            return response()->json([
                'message' => 'auth errors'
            ]);
        }
    }
}
