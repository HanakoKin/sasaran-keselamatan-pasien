<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Lapin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    // Profile Page
    public function index()
    {
        $title = 'Profile Page';
        $user = Auth::user();
        $lapins = Lapin::orderBy('created_at', 'desc');

        if (!Auth::user()->role === 'admin') {
            $lapins->where('unit_kerja', Auth::user()->unit);
        }

        $lapins = $lapins->get();
        $total = $lapins->count();

        return view('pages.user.profile', compact('title', 'user', 'total'));
    }

    // Setting Page
    public function showSetting()
    {
        $title = 'Setting Page';
        $user = User::where('id', Auth::user()->id)->first();
        $lapins = Lapin::orderBy('created_at', 'desc');

        if (!Auth::user()->role === 'admin') {
            $lapins->where('unit_kerja', Auth::user()->unit);
        }

        $lapins = $lapins->get();
        $total = $lapins->count();

        return view('pages.user.setting', compact('title', 'user', 'total'));
    }

    // Change Password Function
    public function changePassword(Request $request)
    {
        $commonRules = [
            'nama' => 'required|max:255'
        ];

        if ($request['current_password'] !== NULL) {
            $commonRules['current_password'] = 'required|string';
            $commonRules['new_password'] = 'required|min:8|different:current_password';
            $commonRules['confirm_password'] = 'required|min:8|same:new_password';
        }

        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        $user = Auth::user();

        if (isset($validatedData['current_password']) && !Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->route('settings')->with('error', 'Current password is incorrect');
        }

        if ($request['current_password'] !== NULL) {
            $user->update([
                'nama' => $validatedData['nama'],
                'password' => Hash::make($validatedData['new_password']),
            ]);
            $message = 'Profile name or password have been updated successfully.';
        } else {
            $user->update([
                'nama' => $validatedData['nama'],
            ]);
            $message = 'Profile name have been updated successfully.';
        }

        return redirect('/dashboard')->with('success', $message);
    }

    // Login Page
    public function login()
    {
        $title = 'Login Page';
        return view('auth.pages.login', compact('title'));
    }

    // Authenticate user login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            return redirect()->intended('dashboard');

        }
        return redirect('/login')->with('error', 'Login Failed!');
    }

    // Register Page
    public function register()
    {
        $title = 'Register Page';
        $unit = Unit::all();
        return view('auth.pages.registration', compact('title', 'unit'));

    }

    // Add User Function
    public function store(Request $request)
    {
        $commonRules = [
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nama' => 'required|max:255',
            'password' => 'required|min:8|max:255',
            'role' => 'required',
        ];

        $roleRules = ($request->role === 'user')
            ? array_merge($commonRules, ['unit' => 'required|string'])
            : array_merge($commonRules, ['unit' => 'nullable|string']);

        $validator = Validator::make($request->all(), $roleRules);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }

    // Logout Function
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');

    }

}
