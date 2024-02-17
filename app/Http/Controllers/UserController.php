<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(){

        $title = 'Login Page';

        return view('auth.pages.login', compact('title'));

    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // dd($credentials);

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            return redirect()->intended('dashboard');

        }

        return back()->with('error', 'Login Failed!');

    }

    public function register(){

        $title = 'Register Page';

        return view('auth.pages.registration', compact('title'));

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nama' => 'required|max:255',
            'password' => 'required|min:5, max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successfull! Please login');

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');

    }

}
