<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Comment;
use \App\Zan;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //列表
    public function index(){
       $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
       $posts_count=Post::all()->count();
        return view("post/index",compact('posts'));
    }

//    详情页
    public function show(Post $post){
        $post->load('comments');
        return view("post/show",compact('post'));
    }
//    创建页面
    public function create(){
        return view("post/create");
    }
//    创建逻辑
    public function store(){
        //验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|max:10000|min:10'
        ]);
        $user_id = \Auth::id();
        $params = array_merge(\request(['title','content']),compact('user_id'));
        $post=Post::create($params);
        return redirect("/posts");
    }
//    编辑文章
    public function  edit(Post $post){
        return view("/post/edit",compact('post'));
    }
//    编辑逻辑
    public function update(Post $post){
//        dd(request()->all());
//    验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|max:10000|min:10'
        ]);
        $this->authorize('update','$post');

//    逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
//    渲染
        return redirect("/posts/{$post->id}");
//
    }

//    删除文章
    public function delete(Post $post){
        $this ->authorize('detele','$post');
        $post->delete();
        return redirect("/posts");
    }
//    图片上传
    public function upload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
        dd(request()->all());
    }
//    测试
    public function  test(){
        return view('post/test');
    }

    public function comment(Post $post){
        $this->validate(\request(),[
            'content'=>'required|min:3|max:200',
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content= request('content');
        $post->comments()->save($comment);

        return back();
    }
    public function zan(Post $post){
        $parm = [
            'user_id' => \Auth::id(),
            'post_id' =>$post->id,
        ];
        Zan::firstOrCreate($parm);
        {
            return back();
        }
    }
    public function unzan(Post $post){
        $post->zan(\Auth::id())->delete();
        return back();
    }
    public function search(){
        //验证
        $this->validate(\request(),[
            'query'=>'required'
        ]);
        //逻辑
        $query = \request('query');
        $posts = \App\Post::search($query)->paginate(2);
        //渲染

        return view('post/search',compact('posts','query'));
    }
}
