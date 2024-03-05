<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){

        $title = 'User Page';


        $users = User::paginate(2);
        return view('pages.admin.user', compact('title', 'users'));

    }
}
