<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAdminUserController extends Controller
{
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->type != 'admin') return abort(401);
        $this->validate($request, [
            'name' => 'sometimes|string',
            'village' => 'sometimes|string',
            'district' => 'sometimes|string',
            'regency' => 'sometimes|string',
            'province' => 'sometimes|string',
            'rekening' => 'sometimes|string',
            'image' => 'sometimes|image',
        ]);

        if ($request->hasFile('image')) {
            $name = date('his') . '.png';
            $user->image()->update(['name' => $name]);
            $request->image->storeAs('public/images', $name);
        }

        $user->update($request->only(['name']));
        $user->address()->update($request->except(['name']));

        return response([
            'message' => 'data updated!',
        ]);
    }
}
