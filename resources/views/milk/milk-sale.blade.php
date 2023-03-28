@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Milk Sales</h4>
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
                <a href="#">Milk</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Milk Sales</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Milk Sales</h4>
                        <a class="btn btn-primary btn-round ml-auto" href="{{route('sale.milk.new')}}">
                            <i class="fa fa-plus"></i>
                            New Milk Sale
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
                                    <th>Source</th>
                                    <th>Contact</th>
                                    <th>Quantity(Ltrs)</th>
                                    <th>Amount(Kes)</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date</th>
                                    <th>Source</th>
                                    <th>Contact</th>
                                    <th>Quantity(Ltrs)</th>
                                    <th>Amount(Kes)</th>
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
            ajax: '{{ route('list-milk-sales') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'date', name: 'date' },
                { data: 'buyer', name: 'buyer' },
                { data: 'contact', name: 'contact' },
                { data: 'quantity', name: 'quantity' },
                { data: 'amount', name: 'amount' },
                { data: 'user', name: 'user' },
                { data: 'action'},
            ]
        });
    });
</script>
@endsection