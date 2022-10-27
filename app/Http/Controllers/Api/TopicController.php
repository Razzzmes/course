<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topic = Topic::all();

        return response()->json([
            'topic' => $topic
        ]);
    }


    public function create()
    {
        //
    }


    public function store(TopicRequest $request)
    {
        $topic = Topic::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'topic added',
            'topic' => $topic,
        ], 200);
    }


    public function show(Topic $topic)
    {
        $topic = Topic::with('messages.user')->find($topic);

        return response()->json([
            'status' => true,
            'topics' => $topic->toArray()
        ], 200);
    }


    public function edit($id)
    {
        //
    }


    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->all());

        return response()->json([
            'message' => 'topic updated',
            'topic' => $topic,
        ]);
    }



    public function destroy(Topic $topic)
    {
        $topic->delete();
        return response()->json([
            'message' => 'topic deleted',
            'topic' => $topic,
        ]);
    }
}