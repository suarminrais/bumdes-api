<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('status', '');
        $user = User::findOrFail(Auth::user()->id);
        if ($user->type == 'admin') return Transaction::where('status', 'like', "%$q%")->latest()->paginate(10);
        return $user->transactions()->where('status', 'like', "%$q%")->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->type == 'admin') return abort(401);
        $this->validate($request, [
            'total' => 'required',
            'product_id' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);

        $product->stock = $product->stock - $request->total;
        $product->save();

        $user->transactions()->create($request->all());

        return response([
            'message' => 'data created!',
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $transaction->update($request->all());

        return response([
            'message' => 'data updated!',
        ]);
    }
}
