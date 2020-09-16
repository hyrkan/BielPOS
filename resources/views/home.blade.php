@extends('layouts.master')
@section('content')
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1>POS <span style="color:blue">{{Auth::user()->store->store_name}}</span></h1>
                    </div>
                    <div class="col-sm-6 float-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Main</li>
                        </ol>
                    </div>
                </div>
            </section> 

            
            <section class="content mt-3" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="app">
                            <Cart></Cart>
                        </div>
                    </div>
                </div>
            </section>
@endsection

        