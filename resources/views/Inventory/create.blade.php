@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add Stock</h1>
            </div>
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/account">Manage Products</a></li>
                <li class="breadcrumb-item active">Add Stock</li>
            </ol>
            </div>
        </div>
        </div>
    </section>
    <section class="content mx-auto">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="/inventory" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name">Add Quantity To {{$product->brand_name}}</label>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="number" class="form-control" id="product_name" name="quantity" placeholder="Quantity" required autocomplete="off"> 
                                    <span class="text-danger" role="alert">{{$errors->first('quantity')}}</span>
                                </div>
                                <button onClick="return confirm('Are you sure about the quantity to be added?')" class="btn btn-primary btn-lg float-right m-3"  type="submit"><i class=" fa fa save"></i> Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

   