@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">New Inventory</h4>
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
                <a href="#">New Inventory</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">New Inventory</h4>
                        <a href="{{route('inventories')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('inventory.create')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input id="tag_id" type="hidden" name="tag_id" class="form-control" value="{{$inventorytag->id}}">
                        <input id="ledger_type" type="hidden" name="ledger_type" class="form-control" value="Expense">
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
                                    <input id="name" type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Inventory Type *</label>
                                    <select class="form-control" id="formGroupDefaultSelect" name="inventory_type" required>
                                        <option value="">-----Select-----</option>
                                        <option value="Asset">Asset</option>
                                        <option value="Stock">Stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Source *</label>
                                    <input id="source" type="text" name="source" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Contact *</label>
                                    <input id="contact" type="text" name="contact" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Unit *</label>
                                    <input id="unit" type="text" name="unit" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Quantity *</label>
                                    <input id="quantity" type="number" name="quantity" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Amount *</label>
                                    <input id="amount" type="number" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Warrant</label>
                                    <input id="warrant" type="text" name="warrant" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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
@endsection