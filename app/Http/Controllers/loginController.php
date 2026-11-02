<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
     public function login(){
        return '<h1>This is the login page</h1>';
     }
       public function login_process(){
        return '<h1>Login completed successfully page</h1>';
     } public function forget_password(){
        return '<h1>Forget password page</h1>';
     }
}
