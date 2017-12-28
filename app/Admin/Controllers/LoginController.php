<?php

namespace App\Admin\Controllers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }
    public function login()
    {
        //验证
        $this->validate(\request(),[
            'name'=>'required|min:2|max:16',
            'password'=>'required|min:6|max:16',
        ]);
        //逻辑
        $user = \request(['name','password']);
        if(\Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }
        //渲染
        return \Redirect::back()->withErrors('账号密码不匹配');
    }
    public function logout()
    {
\Auth::guard("admin")->logout();
return redirect('/admin/login');
    }
}