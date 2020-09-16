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
                <li class="breadcrumb-item active"><a href="/account">Accounts</a></li>
                <li class="breadcrumb-item active">Add New Account</li>
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
                            <form action="/account" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="firstname" placeholder="first name" required autocomplete="off"> 
                                    <span class="text-danger" role="alert">{{$errors->first('firstname')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lastname" placeholder="last name" required>
                                    <span class="text-danger" role="alert">{{$errors->first('lastname')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="username" required> 
                                    <span class="text-danger" role="alert">{{$errors->first('username')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                                    <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Password Confirmation</label>
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirmation" placeholder="password" required>
                                    <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Role</label>
                                    <select class="form-control" id="designation" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Assign Store</label>
                                    <select class="form-control" id="designation" name="store_id">
                                        @foreach($stores as $store)
                                            <option value="{{$store->id}}">{{$store->store_name}}</option>
                                        @endforeach
                                    </select>
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

   