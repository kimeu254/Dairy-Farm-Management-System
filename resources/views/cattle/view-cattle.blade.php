@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Cattle</h4>
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
                <a href="#">Cow</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Cow</h4>
                        <a href="{{route('cattle')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Cattle No *</label>
                                    <input id="fname" type="text" name="fname" class="form-control" value="{{$cattle->cattle_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Breed *</label>
                                    <input id="lname" type="text" name="lname" class="form-control" value="{{$cattle->breed->title}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Stall *</label>
                                    <input id="id_no" type="number" name="id_no" class="form-control" value="{{$cattle->stall->stall_no}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Weight(Kgs) *</label>
                                    <input id="phone" type="number" name="phone" class="form-control" value="{{$cattle->weight}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Farm Entry Date</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$cattle->farm_entry_date}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Amount Purchased(Kes)</label>
                                    <input id="town" type="text" name="town" class="form-control" value="{{$cattle->purchase_amt}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>current_value(Kes)</label>
                                    <textarea class="form-control" name="address" id="address" rows="2" readonly>{{$cattle->current_value}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Comments </label>
                                    <textarea class="form-control" name="comments" id="comments" rows="5" readonly>{{$cattle->comments}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Status *</label>
                                    <input type="text" class="form-control" value="{{$cattle->status}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Added By *</label>
                                    <input type="text" class="form-control" value="{{$cattle->user->fname}} {{$cattle->user->lname}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Calves *</label>
                                    @foreach($calves as $calf)
                                    <h5>{{$calf->calf_no}}</h5>
                                    @endforeach
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