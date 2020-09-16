@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add New  Store</h1>
            </div>
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/store">Manage Store</a></li>
                <li class="breadcrumb-item active">Add New Store</li>
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
                            <form action="/store" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="sname">Store Name</label>
                                    <input type="text" class="form-control" id="sname" name="store_name" placeholder="Store Name"> 
                                </div>
                                <div class="form-group">
                                    <label for="address">Store Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Store Address">
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