<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    //列表
    public function index(){
       $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view("post/index",compact('posts'));
    }

//    详情页
    public function show(Post $post){
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

//        $post = Post::create(\request(['title','content']));
        $post=Post::create(request(['title','content']));
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


}
