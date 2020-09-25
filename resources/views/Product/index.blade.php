@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Manage Products</h1>
            </div>
            
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Manage Products</li>
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
                                        @if(Session::has('message'))
                                            <div>
                                                <p class="alert text-center {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                            </div>
                                        @endif
                                        @if(Session::has('delete'))
                                            <div>
                                                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('delete') }}</p>
                                            </div>
                                        @endif
                                </div>
                                <div class="col-sm-3 float-right">
                                    <a href="/product/create" class="btn btn-success float-right "> <i class="fa fa-plus"></i> Add New Product </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Product Name</th>
                                    <th>Brand Name</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Original Price</th>
                                    <th>Selling Price</th>
                                    <th>In Stock</th>
                                    <th>Low Stock Settings</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->barcode}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->brand_name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>{{$product->unit}}</td>
                                            <td>{{$product->original_price}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->set_low}}</td>
                                            <td>
                                                <div class="d-flex flex-row justify-content-center">
                                                    <div class="p-2"><a href="/product/{{$product->id}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a></div>
                                                    <div class="p-2"><a href="/inventory/{{$product->id}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Stock</a></div>
                                                    <div class="p-2"> 
                                                        <form action="/product/{{$product->id}}" method="POST">
                                                            @csrf 
                                                            @method("DELETE")
                                                            <button  onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                </div> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Product Name</th>
                                    <th>Product Brand</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Original Price</th>
                                    <th>Selling Price</th>
                                    <th>In Stock</th>
                                    <th>Low Stock Settings</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection

@section('scripts')
    <script>
        $('#example1').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'print', text: '<i class="fas fa-print">Print</i>' },
                ]
            });
            table.button( '2-4' ).remove();
    </script>
@endsection