@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">User Profile</h4>
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
                <a href="#">User</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Profile</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Profile</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('profile.update')}}" method="POST">
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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong class="px-3">Error! Something went wrong</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>First Name *</label>
                                    <input id="fname" type="text" name="fname" class="form-control" value="{{Auth::user()->fname}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Last Name *</label>
                                    <input id="lname" type="text" name="lname" class="form-control" value="{{Auth::user()->lname}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Email *</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Role *</label>
                                    <input id="role_id" type="text" name="role_id" class="form-control" value="{{Auth::user()->roles->first()->display_name}}" readonly>
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