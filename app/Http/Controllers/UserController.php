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
        if ($name != $user->name){
            if (User::where('name',$name)->count()>0){
                return back()->withErrors('用户名已被占用');
            }
            $user->name = $name;

    }
    if (\request()->file('avatar')){
            $path = request()->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;

    }
    $user->save();
        //渲染
        return back();
    }
}
