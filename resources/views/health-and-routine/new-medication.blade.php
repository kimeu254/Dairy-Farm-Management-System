@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">New Medication</h4>
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
                <a href="#">Health & Routine</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">New Medication</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">New Medication</h4>
                        <a href="{{route('medications')}}" class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('medication.create')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input id="tag_id" type="hidden" name="tag_id" class="form-control" value="{{$medictag->id}}">
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
                                <div class="form-check">
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="optionsRadios" id="cattle01" value="cattle" onclick="Check();">
                                        <span class="form-radio-sign">Cattle</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="optionsRadios" id="calf01" value="calf" onclick="Check();">
                                        <span class="form-radio-sign">Calf</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12" id="cattle02" style="display: none">
                                <div class="form-group form-group-default">
                                    <label>Cattle *</label>
                                    <select class="form-control" id="cattle_id" name="cattle_id" required>
                                        <option value="">-----Select-----</option>
                                        @foreach($cattle as $cattle)
                                        <option value="{{$cattle->id}}">{{$cattle->cattle_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12" id="calf02" style="display: none">
                                <div class="form-group form-group-default">
                                    <label>Calf *</label>
                                    <select class="form-control" id="calf_id" name="calf_id" required>
                                        <option value="">-----Select-----</option>
                                        @foreach($calves as $calf)
                                        <option value="{{$calf->id}}">{{$calf->calf_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Vet/Company Name *</label>
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
                                    <label>Medicine Name *</label>
                                    <input id="medication_name" type="text" name="medication_name" class="form-control" required>
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
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Next Appointment Date *</label>
                                    <input id="next_appointment" type="date" name="next_appointment" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Vet Remarks *</label>
                                    <textarea class="form-control" name="vet_remarks" id="vet_remarks" rows="3" required></textarea>
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
<script type="text/javascript">
    function Check() {
        if (document.getElementById('cattle01').checked) {
            document.getElementById('calf02').style.display = 'none';
            document.getElementById('cattle02').style.display = 'block';
            document.getElementById('calf_id').required = false;
        } 
        else if(document.getElementById('calf01').checked){
            document.getElementById('calf02').style.display = 'block';
            document.getElementById('cattle02').style.display = 'none';
            document.getElementById('cattle_id').required = false;

        }
    }
</script>
@endsection