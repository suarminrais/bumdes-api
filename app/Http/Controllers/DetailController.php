<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDetailRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailRequest  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->type == 'admin') return abort(401);
        $user->update($request->only('name'));
        $user->detail()->update($request->except('name'));

        return response([
            'message' => 'data updated!',
        ]);
    }
}
