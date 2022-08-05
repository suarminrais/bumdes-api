<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->query('category', '');
        $id = $request->query('id', '');
        $product = Product::findOrFail($id);
        if ($product) return Product::where('category', 'like', "%$q%")->where('id', '<>', $product->id)->where('price', '>', $product->price)->orderBy('grade')->paginate(10);
        return Product::where('category', 'like', "%$q%")->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $name = date('his') . '.png';
        $user = User::findOrFail(Auth::user()->id);
        $product = $user->products()->create($request->except('image'));
        $request->image->storeAs('public/images', $name);
        $product->image()->create(['name' => $name]);

        return response([
            'message' => 'data created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $name = date('his') . '.png';
            $product->image()->update(['name' => $name]);
            $request->image->storeAs('public/images', $name);
        }
        $product->update($request->except('image'));

        return response([
            'message' => 'data updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->image->delete();
        $product->delete();

        return response([
            'message' => 'data deleted!',
        ]);
    }
}
