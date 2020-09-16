@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Update Product</h1>
            </div>
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/account">Manage Products</a></li>
                <li class="breadcrumb-item active">Update Product</li>
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
                            <form action="/product/{{$product->id}}" method="POST">
                                @csrf
                                @method("PATCH")
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required autocomplete="off"
                                    value="{{$product->product_name}}"> 
                                    <span class="text-danger" role="alert">{{$errors->first('product_name')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" required
                                    value="{{$product->brand_name}}">
                                    <span class="text-danger" role="alert">{{$errors->first('brand_name')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" required
                                    value="{{$product->description}}">
                                    <span class="text-danger" role="alert">{{$errors->first('description')}}</span>
                                </div>
                                                                
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option value="pcs" {{($product->unit == "pcs"? "Selected" : '')}}>Pieces</option>
                                        <option value="box" {{($product->unit == "box"? "Selected" : '')}}>Box</option>
                                        <option value="other" {{($product->unit == "other"? "Selected" : '')}}>Other</option>
                                    </select>
                                    <span class="text-danger" role="alert">{{$errors->first('unit')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required step="any"
                                    value="{{$product->price}}">  
                                    <span class="text-danger" role="alert">{{$errors->first('price')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="set_low">Set Low Stock</label>
                                    <input type="number" class="form-control" id="set_low" name="set_low" placeholder="Set Low Stock" required
                                    value="{{$product->set_low}}">
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

   