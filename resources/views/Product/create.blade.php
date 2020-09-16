@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add New  Account</h1>
            </div>
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/account">Manage Products</a></li>
                <li class="breadcrumb-item active">Add New Product</li>
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
                        <div class="card-body">
                            <form action="/product" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="barc">Generate Barcode</label>
                                    <input type="text" class="form-control" id="barc" name="barcode" placeholder="Barcode" required autocomplete="off"> 
                                    <span class="text-danger" role="alert">{{$errors->first('barcode')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required autocomplete="off"> 
                                    <span class="text-danger" role="alert">{{$errors->first('product_name')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" required>
                                    <span class="text-danger" role="alert">{{$errors->first('brand_name')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                                    <span class="text-danger" role="alert">{{$errors->first('description')}}</span>
                                </div>
                                                                
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option value="pcs">Pieces</option>
                                        <option value="box">Box</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <span class="text-danger" role="alert">{{$errors->first('unit')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required step="any">  
                                    <span class="text-danger" role="alert">{{$errors->first('price')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="set_low">Set Low Stock</label>
                                    <input type="number" class="form-control" id="set_low" name="set_low" placeholder="Set Low Stock" required>
                                    <span class="text-danger" role="alert">{{$errors->first('set_low')}}</span>
                                </div>
                                <button class="btn btn-primary btn-lg float-right m-3"  type="submit"><i class=" fa fa save"></i> Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

   