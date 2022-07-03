<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'type' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->image()->create([
            'name' => 'default.png',
        ]);

        $user->address()->create();
        $user->detail()->create();

        return response([
            'message' => 'success registered user!',
        ]);
    }
}
