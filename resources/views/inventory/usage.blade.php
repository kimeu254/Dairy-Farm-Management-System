@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Usage</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Inventory Management</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Usage</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Usage</h4>
                        <a class="btn btn-primary btn-round ml-auto" href="{{route('usage.new')}}">
                            <i class="fa fa-plus"></i>
                            New Inventory Usage
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Initial Quantity</th>
                                    <th>Used Quantity</th>
                                    <th>Remaining Quantity</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Initial Quantity</th>
                                    <th>Used Quantity</th>
                                    <th>Remaining Quantity</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module">
    var save_method; //for save method string
    var table;
    
    $(document).ready(function() {
      table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'asc'] ],
            ajax: '{{ route('list-usages') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'date', name: 'date' },
                { data: 'name', name: 'name' },
                { data: 'unit', name: 'unit' },
                { data: 'initial_qty', name: 'initial_qty' },
                { data: 'used_qty', name: 'used_qty' },
                { data: 'final_qty', name: 'final_qty' },
                { data: 'description', name: 'description' },
                { data: 'user', name: 'user' },
                { data: 'action'},
            ]
        });
    });
</script>
@endsection