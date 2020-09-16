@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Manage Inventory</h1>
            </div>
            
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Manage Inventory</li>
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
                            </div>
                        </div>
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                            <th>Product Name</th>
                            <th>Brand Name</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Low Stock</th>
                            <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->brand_name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->unit}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->set_low}}</td>
                                        <td>
                                            <a href="/inventory/{{$product->id}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Stock</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Product Name</th>
                            <th>Product Brand</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Low Stock</th>
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
        $(function () {    
            $('#example1').DataTable();
        });
    </script>
@endsection