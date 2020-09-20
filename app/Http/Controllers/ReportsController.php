<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Products;
use App\Order;
use App\Cart;
use Carbon\Carbon;
use DB;
use PDF;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_id = auth()->user()->store_id;

        //fetch all transactions done today
        $transactions_today = Invoice::where('store_id', '=', $store_id)
                                ->whereDate('created_at', '=', Carbon::today())
                                ->get();
                            
        //fetch all items from the transactions
        $orders = DB::table('orders')
                            ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
                            ->where('invoices.store_id','=', $store_id)
                            ->whereDate('orders.created_at', '=', Carbon::today())
                            ->select('*')
                            ->get();

        $past_transactions = Invoice::where('store_id', '=', $store_id)
                            ->whereDate('created_at', '!=', Carbon::today())
                            ->get();

        $total_revenue =  $transactions_today->sum('total_price');

        
        $inid = Invoice::latest()->first();

           
        return view('Reports.index',compact('transactions_today', 'orders', 'total_revenue','past_transactions','inid'));
    }

    public function invoice($id){

        
        $orders = DB::table('orders')
        ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
        ->where('invoices.id','=', $id)
        ->whereDate('orders.created_at', '=', Carbon::today())
        ->select('*')
        ->get();

        $pdf = PDF::loadView('myPDF', ['orders' => $orders, ])->setPaper(array(0,0,204,650));;
        
  
        return $pdf->stream('itsolutionstuff.pdf');
    }

    
}
