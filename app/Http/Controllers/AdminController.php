<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Lapin;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {

        $title = 'User Page';

        $users = User::orderBy('created_at', 'desc')->get();

        // dd($users);

        $totals = $users->count();
        return view('pages.admin.user', compact('title', 'users', 'totals'));
    }

    public function addUserForm()
    {

        $title = 'Add User Page';

        $unit = Unit::all();

        return view('pages.admin.addUser', compact('title', 'unit'));
    }

    public function addUser(Request $request)
    {

        if ($request->role === 'admin' && $request->unit === NULL) {
            $request->merge(['unit' => 'Admin']);
        } else if ($request->role === 'Tim SKP' && $request->unit === NULL) {
            $request->merge(['unit' => 'Tim SKP']);
        }

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

        return redirect()->route('users')->with('success', 'User addedd successfully!');
    }

    public function editUser($id)
    {

        $title = 'Edit User';

        $data = User::findOrFail($id);

        // dd($data);

        $unit = Unit::all();

        return view('pages.admin.editUser', compact('data', 'title', 'unit'));
    }

    public function updateUser(Request $request, $id)
    {

        if ($request->role === 'admin') {
            $request->merge(['unit' => 'Admin']);
        } else if ($request->role === 'Tim SKP') {
            $request->merge(['unit' => 'Tim SKP']);
        }

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($id)],
            'nama' => 'required|max:255',
            'role' => 'required',
            'unit' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        User::where('id', $id)->update($validatedData);

        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'UNAUTHORIZED ACTION');
        }
        // Hapus data User
        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    public function getUserInfo($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $lapin = Lapin::where('unit_kerja', $user->unit)->get();

        if (isset($lapin)) {
            $totalLapin = $lapin->count();
        } else {
            $totalLapin = 0;
        }


        return response()->json([
            'user' => $user,
            'totalLapin' => $totalLapin
        ]);
    }
}
