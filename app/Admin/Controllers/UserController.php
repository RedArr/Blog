<?php

namespace App\Admin\Controllers;
use \App\AdminUser;

class UserController extends Controller
{
    //管理员列表
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin/user/index',compact('users'));
    }
    //管理员创建页面
    public function  create()
    {
        return view('/admin/user/add');
    }
    //创建管理员逻辑
    public function store(){
    //验证
        $this->validate(request(),[
            'name'=>'required|min:3',
            'password'=>'required'
        ]);
    //逻辑
        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name','password'));
    //渲染
        return redirect('/admin/users');
    }

    public function test()
    {
        return view('/admin/user/test');
    }

    //删除用户
    public function delete(AdminUser $user)
    {
        $user->delete();
        return redirect('/admin/users');
    }

}