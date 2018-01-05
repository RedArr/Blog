<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function setting(Request $request)
    {
        $user = \Auth::user();
        return view('user/setting',compact('user'));
    }
    public function settingStore()
    {
        //验证
        $this->validate(\request(),[
            'name'=>'required|min:3',
            ]);
        //业务逻辑
        $name= request('name');
        $user = \Auth::user();
        if ($name != $user->name)
        {
            if (User::where('name',$name)->count()>0)
            {
                return back()->withErrors('用户名已被占用');
            }
            $user->name = $name;

        }
        if (\request()->file('avatar'))
        {
            $path = request()->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;
        }
        $user->save();
        //渲染
        return back();
    }
    public function show(User $user)
    {
        //关注粉丝文章数

        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //文章前10条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //关注的用户 关注/粉丝/文章
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //粉丝用户 关注/粉丝/文章
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();
        return view('user/show',compact('user','susers','fusers','posts'));
    }
    //关注
    public function  fan(User $user)
    {
        $me = \Auth::user();
        $me ->doFan($user->id);

        return [
            'error'=>0,
            'msg'=>''
        ];
    }
    //取消关注
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me ->doUnFan($user->id);

        return [
            'error'=>0,
            'msg'=>''
        ];
    }
}
