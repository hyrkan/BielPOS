@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Manage Store</h1>
            </div>
            
            <div class="col-sm-6 float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Manage Stores</li>
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
                                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                            </div>
                                        @endif
                                        @if(Session::has('delete'))
                                            <div>
                                                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('delete') }}</p>
                                            </div>
                                        @endif
                                </div>
                                <div class="col-sm-3 float-right">
                                    <a href="/store/create" class="btn btn-success float-right "> <i class="fa fa-plus"></i> Add New Store </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                            <th>Store Name</th>
                            <th>Address</th>
                            <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($stores as $store)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{$store->id}}">
                                    <td>{{$store->store_name}}</td>
                                    <td>{{$store->address}}</td>
                                    <td>
                                    <div class="d-flex flex-row justify-content-center">
                                    <div class="p-2"><a href="/store/{{$store->id}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a></div>
                                    <div class="p-2"> 
                                        <form action="/store/{{$store->id}}" method="POST">
                                            @csrf 
                                            @method("DELETE")
                                            <button  onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class="fa fa-trash"></i>DELETE</button>
                                        </form>
                                    </div>                   
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Store Name</th>
                            <th>Address</th>
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