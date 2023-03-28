@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">New Usage</h4>
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
                <a href="#">Inventories</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">New Usage</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">New Usage</h4>
                        <a href="{{route('usages')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('usage.create')}}" method="POST">
                        @csrf
                        @method('POST')
                        @if(Session::has('message'))
                        <div class="alert alert-dismissible alert-success text-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success!</h4>
                            <p>{{session('message')}}</p>
                        </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-dismissible alert-danger text-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Error!</h4>
                            <p>{{session('error')}}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Date *</label>
                                    <input id="date" type="date" name="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Inventory Name *</label>
                                    <select class="form-control" id="inventory_id" name="inventory_id" required>
                                        <option value="">-----Select-----</option>
                                        @foreach($inventories as $inventory)
                                        @if($inventory->ledger->remaining_quantity >= 1)
                                        <option value="{{$inventory->id}}">
                                            {{$inventory->ledger->name}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach($inventories as $inventory)
                            <div class="col-md-6 some" style="display: none" id="some_{{$inventory->id}}">
                                <div class="form-group form-group-default">
                                    <label>Current Quantity *</label>
                                    <input type="text" class="form-control" name="initial_qty" value="{{$inventory->ledger->remaining_quantity}}" readonly required>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Quantity Used *</label>
                                    <input id="used_qty" type="number" name="used_qty" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Description *</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe stock usage..." required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module">
    $('#inventory_id').on('change',function(){
    $(".some").hide();
    var some = $(this).find('option:selected').val();
    $("#some_" + some).show();}); 
</script>
                                
@endsection