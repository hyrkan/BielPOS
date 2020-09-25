<?php

namespace App\Http\Controllers;

use App\Product;
use App\StockIn;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('store_id', '=', auth()->user()->store_id)->get();
        return view('Product.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $user = auth()->user();
        
        request()->validate([

            'product_name' => 'required',
            'brand_name' => 'required',
            'unit' => 'required',
            'price' => 'required|max:6',
            'description' => 'required',
            'set_low' => 'required',
            'barcode' => 'required|unique:products',
            'original_price' => 'required|max:6',
            'quantity' => 'required'
        ]);


        $product_id = Product::create([

            'product_name' => $request['product_name'],
            'brand_name' => $request['brand_name'],
            'unit' => $request['unit'],
            'price' => $request['price'],
            'description' => $request['description'],
            'set_low' => $request['set_low'],
            'store_id' => $user->store->id,
            'barcode' => $request['barcode'],
            'original_price' => $request['original_price'],
            'quantity' => $request['quantity']
            
        ]);

        StockIn::create([
            'product_id' => $product_id->id,
            'quantity_added' => $request['quantity'],
            'store_id' => auth()->user()->store->id,
            'user_id' => auth()->user()->id
        ]);
        

        return redirect('/product')->with('message', 'Successfully Added A New Product');


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('Product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($this->validateRequest());
        return redirect('/product')->with('message','Successfully Updated The Product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product')->with('delete','Product Succesfully Deleted');
    }

    private function validateRequest(){
        return request()->validate([
            'product_name' => 'required',
            'brand_name' => 'required',
            'unit' => 'required',
            'price' => 'required|max:6',
            'description' => 'required',
            'set_low' => 'required',
            'barcode' => 'required|unique:products',
            'original_price' => 'required|max:6',
        ]);
    }
}
