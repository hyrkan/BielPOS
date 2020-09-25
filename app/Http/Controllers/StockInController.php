<?php

namespace App\Http\Controllers;

use App\StockIn;
use Illuminate\Http\Request;
use App\Product;
use DB;
class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        request()->validate([
            'quantity' => "required|numeric",
            'product_id' => "required"
        ]);
    
        StockIn::create([
            'product_id' => $request['product_id'],
            'quantity_added' => $request['quantity'],
            'store_id' => auth()->user()->store->id,
            'user_id' => auth()->user()->id
        ]);

        $test = DB::table('products')->whereid($request->product_id)
                            ->where('store_id', '=', auth()->user()->store->id) 
                            ->Increment('quantity', $request['quantity']);
                            
        return redirect('/product')->with('message','Successfully Added Stock On The Product');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view('Inventory.create',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function edit(StockIn $stockIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockIn $stockIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockIn $stockIn)
    {
        //
    }
}
