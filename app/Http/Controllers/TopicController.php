<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        //带文章属的专题
        $topic = Topic::withCount('postTopics');
        dd();
        //专题的文章列表，按照时间倒序排列，前10个
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
//        return view('topic/show',compact('topic','posts'));
    }

    public function submit(Topic $topic)
    {
        return;
    }
}
