<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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

        // dd($credentials);

        return redirect('/login')->with('error', 'Login Failed!');

    }

    public function register(){

        $title = 'Register Page';

        $unit = Unit::all();

        return view('auth.pages.registration', compact('title', 'unit'));

    }

    public function store(Request $request){
        // Define common validation rules
        $commonRules = [
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nama' => 'required|max:255',
            'password' => 'required|min:8|max:255',
            'role' => 'required',
        ];

        // Role-specific validation rules
        $roleRules = ($request->role === 'user')
            ? array_merge($commonRules, ['unit' => 'required|string'])
            : array_merge($commonRules, ['unit' => 'nullable|string']);

        // Validate the request
        $validator = Validator::make($request->all(), $roleRules);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        // Validation passed, continue processing
        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }


    public function logout(Request $request){

        Auth::logout();

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Log Out successful! Have a nice Day :)');

    }

}
