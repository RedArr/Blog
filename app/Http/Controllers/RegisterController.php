<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'email'=>'required'
        ])
    }
}
