<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Products;
use App\Order;
use App\Cart;
use Carbon\Carbon;
use DB;
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

        $transactions_today = Invoice::where('store_id', '=', $store_id)
                                ->whereDate('created_at', '=', Carbon::today())
                                ->get();
                                

        $orders = DB::table('orders')
                            ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
                            ->where('invoices.store_id','=', $store_id)
                            ->whereDate('created_at', '=', Carbon::today())
                            ->select('*')
                            ->get();

        
        $past_transactions = Invoice::where('store_id', '=', $store_id)
                            ->whereDate('created_at', '!=', Carbon::today())
                            ->get();

                            
        $total_revenue =  $transactions_today->sum('total_price');

        return view('Reports.index',compact('transactions_today', 'orders', 'total_revenue','past_transactions'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
