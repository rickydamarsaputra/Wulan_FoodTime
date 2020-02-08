<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        $registeredUsers = User::count();
        $registeredMenus = Menu::count();
        $users = User::all();
        return view('admin._dashboard', compact('registeredUsers', 'registeredMenus', 'users'));
    }
}
