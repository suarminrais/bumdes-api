<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->type == 'admin') return abort(401);
        $this->validate($request, [
            'name' => 'sometimes|string',
            'email' => 'sometimes|string',
            'password' => 'sometimes|confirmed|string',
            'image' => 'sometimes|image',
        ]);

        if ($request->hasFile('image')) {
            $name = date('his') . '.png';
            $user->image()->update(['name' => $name]);
            $request->image->storeAs('public/images', $name);
        }

        $user->update($request->only(['name', 'email']));

        if ($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return response([
            'message' => 'data updated!',
        ]);
    }
}
