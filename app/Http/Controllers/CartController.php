<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Invoice;
use Carbon\Carbon;
use App\Order;
use DB;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
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
        $printer -> initialize();
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("Samson Store\n");
        $printer -> selectPrintMode();
        $printer -> text("Shop No. 001.\n");
        $printer -> text($inID->invoice);
        $printer -> feed();

        $printer -> setEmphasis(true);
        $printer -> text("SALES INVOICE\n");
        $printer  -> text('\n');
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> text(str_pad("Item", 10, " "));
        $printer -> text(str_pad("Qty", 6, " "));
        $printer -> text(str_pad("Price", 8 , " "));
        $printer -> text("Total \n");
        $printer -> setEmphasis(false);


        foreach($data['cart'] as $cart)
        {
            $subtotal = $cart['quantity'] * $cart['price']; 
            $printer -> text(str_pad($cart['product_name'] , 10 ," "));
            $printer -> text(str_pad($cart['quantity'] , 6 ," "));
            $printer -> text(str_pad($cart['price'] , 8 ," "));
            $printer -> text($subtotal."\n");
            
        }


        $printer -> feed();
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("Total : ".$data['total']);
        $printer -> selectPrintMode();

        /* Footer */
        $printer -> feed(2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("Thank you for shopping at Samson Store \n");
        $printer -> text("For trading hours, please call us at 09xxxxx\n");
        $printer -> feed(2);
        $printer -> text($date . "\n");
        $printer -> cut();
        $printer -> pulse();
        $printer -> close();

    }

    public function getAllproduct(){
        $products = Product::where('store_id', '=', auth()->user()->store_id)->get();
        return response()->json($products);
    }


    
}
