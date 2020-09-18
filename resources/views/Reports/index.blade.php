@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Reports</h1>
            </div>
            
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ol>
            </div>
        </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-9">
                                       <h1>Transactions</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Transactions Today</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Items Bought</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active pt-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <table  id="example1" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Revenue Per Billing</th>
                                                <th>Date</th>
                                                <th>Total Revenue : &#8369;{{$total_revenue}}</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            @foreach($transactions_today as $transaction)
                                            <tr>
                                                <td>{{$transaction->invoice}}</td>
                                                <td>P {{$transaction->total_price}}</td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:m:s')}}</td>
                                                <td>-</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Revenue Per Billing</th>
                                                <th>Date</th>
                                                <th>Total Revenue : &#8369;{{$total_revenue}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>                                
                                
                                </div>
                                <div class="tab-pane fade pt-4" id="past" role="tabpanel" aria-labelledby="profile-tab">
                                    <table  id="example3" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Revenue Per Billing</th>
                                                <th>Date</th>
                                               
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            @foreach($past_transactions as $p_transaction)
                                            <tr>
                                                <td>{{$p_transaction->invoice}}</td>
                                                <td>&#8369; {{$p_transaction->total_price}}</td>
                                                <td>{{ \Carbon\Carbon::parse($p_transaction->created_at)->format('d/m/Y H:m:s')}}</td>
                                                <td>-</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Revenue Per Billing</th>
                                                <th>Date</th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>        
                                </div>
                                <div class="tab-pane fade pt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <table  id="example2" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Product Name</th>
                                                <th>Brand Name</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->invoice}}</td>
                                                <td>{{$order->product_name}}</td>
                                                <td>{{$order->brand_name }}</td>
                                                <td>{{$order->unit}}</td>
                                                <td>{{$order->quantity}}</td>
                                                <td>&#8369;{{$order->price }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Billing ID</th>
                                                <th>Product Name</th>
                                                <th>Brand Name</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                            </tr>
                                        </tfoot>
                                    </table>   
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('scripts')
    <script>
        $(function () {    
            $('#example1').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'print', text: '<i class="fas fa-print">Print</i>' },
                ]
            });


            $('#example2').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'print', text: '<i class="fas fa-print">Print</i>' },
                ]
            });

            $('#example4').DataTable();
        });
    </script>
@endsection

