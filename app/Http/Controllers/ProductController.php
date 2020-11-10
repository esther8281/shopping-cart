<?php

namespace App\Http\Controllers;

use App\Product;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::where('creator_id',$user->id)->orderBy('id', 'DESC')->get();
        return view('pages.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $response = Product::create([ 
          'name' => $request->name,
          'price' => $request->price,
          'quantity' => $request->quantity,
          
      ]);
      if ($request->file('avatar')) {
            $response->update([
                'avatar' =>  $request->file('avatar')->store('public/avatar'),
            ]);
       }
      return redirect('product/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('pages.product.edit',[
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $response = $product->update([
          'name' => $request->name,
          'price' => $request->price,
          'quantity' => $request->quantity,
        ]);

        if ($response && $request->file('avatar')) {
            if ($product->avatar && \Storage::disk('local')->exists($product->avatar)) {
                \Storage::delete($product->avatar);
            }
            $product->update([
                'avatar' =>  $request->file('avatar')->store('public/avatar'),
            ]);
        }
       return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id); 
        $response = $product->delete();
         if ($response && $product->avatar && \Storage::disk('local')->exists($product->avatar)) {
            \Storage::delete($product->avatar);
        }
        return redirect('product');
    }
    public function shoppingpProduct()
    {
        $products = Product::where('status',1)->orderBy('id', 'DESC')->get();
        return view('pages.front-end.product', [
            'products' => $products,
        ]);
    }
    
}
