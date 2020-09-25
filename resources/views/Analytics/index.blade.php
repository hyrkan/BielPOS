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
                <li class="breadcrumb-item active">Analytics</li>
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
                                       <h1>Inventory Reports</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <table id="inventory_added" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Brand Name</th>
                                <th>Description</th>
                                <th>Quantity Added</th>
                                <th>Date Added</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Brand Name</th>
                                    <th>Description</th>
                                    <th>Quantity Added</th>
                                    <th>Date Added</th>
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

            $('#inventory_added').DataTable();
        });
    </script>
@endsection

