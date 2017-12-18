<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }
    public function register()
    {
        $this->vaildate(\request(),[
            'name'=>'required|min:3|unique:user,name',
            'email'=>'required|unique:users:email|email',
            'password'=>'required|min:6|max:16|confirmed',
        ]);

        $name = \request('name');
        $email = \request('email');
        $password = \bcrypt(\request('password'));
        $user = User::create('name','email','password');

        return redirect('/login');
    }
}
