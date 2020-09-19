<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Invoice;
use Carbon\Carbon;
use App\Order;
use DB;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart_contents = Cart::with('products');
        return response()->json($cart_contents);
    }


    //a product is requested through barcode
    public function getProduct(Request $request){
        
        
        request()->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);
        $barcode = $request->barcode;
        $products = DB::table('products')->where('store_id', '=', auth()->user()->store->id) 
            ->where('barcode', '=', $barcode)
            ->where('quantity', '!=', 0)
            ->get();

        return response()->json($products);


    }


    public function getTransact(){
        $transactions = Invoice::where('store_id', '=', auth()->user()->store_id)
                                ->whereDate('created_at', '=', Carbon::today())->get();
        return response()->json(sizeof($transactions));
    }

    //geting all the products from a specific store that is currently in low stock
    public function getLowStock(Request $resquest){
        $current_low = [];
        $products = Product::where('store_id', '=', auth()->user()->store_id)->get();
        foreach($products as $product){
           if($product->quantity <= $product->set_low){
                $current_low[] = [
                    $product
                ];
           }
        }

        return response()->json(sizeof($current_low));
        
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

    //storing all orders from the cart
    public function store(Request $request)
    {



        $data = request()->all();
        $date = Carbon::now();
        $store_id = auth()->user()->store_id;
        $inID = '';
        $prev_id = Invoice::where('store_id',$store_id)->pluck('id')->last();
        $added_id = $prev_id + 1;
        $one = 1;


        if($prev_id){
            $inID = Invoice::create([
                'invoice' => 'SAM'.$store_id.'-'.$date->format('Y').'-'.$added_id,
                'store_id' =>  $store_id,
                'total_price' => $data['total']
            ]);
        }else{
            $inID = Invoice::create([
                'invoice' => 'SAM'.$store_id.'-'.$date->format('Y').'-'.$one,
                'store_id' =>  $store_id,
                'total_price' => $data['total']
            ]);
        }

        foreach($data['cart'] as $cart)
        {
            if(!empty($cart))
            {
                Order::create([

                    'product_name' => $cart['product_name'],
                    'brand_name' => $cart['brand_name'],
                    'unit' => $cart['unit'],
                    'price' => $cart['price'],
                    'quantity' => $cart['quantity'],
                    'invoice_id' => $inID->id
                ]);

                DB::table('products')->whereid($cart['id'])
                    ->where('store_id', '=', $store_id) 
                    ->Decrement('quantity',$cart['quantity']);

            }
        }


        $connector = new WindowsPrintConnector("EPSON TM-U220 Receipt");
        $printer = new Printer($connector);
        $printer -> text("Hello World!\n");
        $printer -> cut();
        $printer -> close();


    
       
 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
