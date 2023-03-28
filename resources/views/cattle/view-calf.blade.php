@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Calf</h4>
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
                <a href="#">Cattle</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Calf</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Calf</h4>
                        <a href="{{route('calf')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Calf No *</label>
                                    <input id="fname" type="text" name="fname" class="form-control" value="{{$calf->calf_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Parent *</label>
                                    <input id="lname" type="text" name="lname" class="form-control" value="{{$calf->cattle->cattle_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Stall *</label>
                                    <input id="id_no" type="number" name="id_no" class="form-control" value="{{$calf->stall->stall_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Breed *</label>
                                    <input id="lname" type="text" name="lname" class="form-control" value="{{$calf->cattle->breed->title}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Weight(Kgs) *</label>
                                    <input id="phone" type="number" name="phone" class="form-control" value="{{$calf->weight}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Birth Date</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$calf->birth_date}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Insemination Type</label>
                                    <input id="town" type="text" name="town" class="form-control" value="{{$calf->insemination_type}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Current Value(Kes)</label>
                                    <input type="text" class="form-control" value="{{$calf->current_value}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Comments </label>
                                    <textarea class="form-control" name="comments" id="comments" rows="5" readonly>{{$calf->comments}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Status *</label>
                                    <input type="text" class="form-control" value="{{$calf->status}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Added By *</label>
                                    <input type="text" class="form-control" value="{{$calf->user->fname}} {{$calf->user->lname}}" readonly>
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