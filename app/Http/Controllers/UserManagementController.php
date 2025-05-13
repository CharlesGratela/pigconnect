<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('admin.users')->with('success', 'User deleted successfully.');
    }
}