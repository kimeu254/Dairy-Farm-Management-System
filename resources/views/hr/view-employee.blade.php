@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Employees</h4>
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
                <a href="#">HR</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Employees</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Employee</h4>
                        <a href="{{route('employees')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>First Name *</label>
                                    <input id="fname" type="text" name="fname" class="form-control" value="{{$employee->fname}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Last Name *</label>
                                    <input id="lname" type="text" name="lname" class="form-control" value="{{$employee->lname}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>ID Number *</label>
                                    <input id="id_no" type="number" name="id_no" class="form-control" value="{{$employee->id_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Phone Number *</label>
                                    <input id="phone" type="number" name="phone" class="form-control" value="{{$employee->phone}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Email </label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$employee->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Town </label>
                                    <input id="town" type="text" name="town" class="form-control" value="{{$employee->town}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Address </label>
                                    <textarea class="form-control" name="address" id="address" rows="2" readonly>{{$employee->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Work Description *</label>
                                    <textarea class="form-control" name="work_description" id="work_description" rows="3" readonly>{{$employee->work_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Salary (kes) *</label>
                                    <input id="salary" type="number" name="salary" class="form-control" value="{{$employee->salary}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Rate *</label>
                                    <input id="rate" type="text" name="rate" class="form-control" value="{{$employee->rate}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Comments </label>
                                    <textarea class="form-control" name="comments" id="comments" rows="5" readonly>{{$employee->comments}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Status *</label>
                                    <input type="text" class="form-control" value="{{$employee->status}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Added By *</label>
                                    <input type="text" class="form-control" value="{{$employee->user->fname}} {{$employee->user->lname}}" readonly>
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