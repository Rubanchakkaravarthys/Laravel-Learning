<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm(){
        return view('register');
    }

    public function register(Request $request){
        $request->validate([
           'name'=>'required',
           'email'=> 'required|email|unique:users,email',
           'password'=>'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role' => 'user',

        ]);
       return redirect('/login');
    }

    public function loginForm(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();

            // role based
            if($user->role=='admin'){
                return redirect('/admin');
            }
            elseif($user->role=='manager'){
                return redirect('/manager');
            }
            return redirect('/dashboard');
        }

        return back()->withErrors(['email'=>'Invalid email or password'])->onlyInput('email','password');

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
