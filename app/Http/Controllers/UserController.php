<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::get();

        return view('user.index', compact('users'));
    }

    public function create() {
        return view('user.create');
    }

    public function save(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable'
        ]);
        $data = $request->except('_token');

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return response()->redirectToRoute('user_list');
    }

    public function edit(Request $request, $id) {
        $user = User::where('id', $id)->first();

        return view('user.create', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ''
        ]);
        $data = $request->except('_token');

//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'role' => $data['role']
//        ]);
    }
}
