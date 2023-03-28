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
                <a href="#">Accounts</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">View Usage</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Usage</h4>
                        <a href="{{route('usages')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Date *</label>
                                    <input id="date" type="date" name="date" class="form-control" value="{{$usage->date}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Name *</label>
                                    <input class="form-control" value="{{$usage->inventory->ledger->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Initial Quantity *</label>
                                    <input id="phone" type="number" name="phone" class="form-control" value="{{$usage->initial_qty}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Used Quantity *</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$usage->used_qty}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Available Quantity *</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$usage->final_qty}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Description *</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" readonly>{{$usage->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Added By *</label>
                                    <input type="text" class="form-control" value="{{$usage->user->fname}} {{$usage->user->lname}}" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection