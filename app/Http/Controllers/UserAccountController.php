<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public $id;
    public function create()
    {
        return inertia('Account/CreateUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $this->id = User::createUser($request);
        Auth::loginUsingId($this->id, true);
        return redirect()->route('listing.index')->with('success', 'Account created!');
    }
}
