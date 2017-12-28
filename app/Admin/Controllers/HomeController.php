<?php

namespace App\Admin\Controllers;

class HomeController extends Controller
{
    public function home(){
        return view('admin.home.index');
    }
}
?>