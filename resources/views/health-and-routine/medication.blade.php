@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Medication & Vaccines</h4>
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
                <a href="#">Medication & Vaccine</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Medication & Vaccine</h4>
                        <a class="btn btn-primary btn-round ml-auto" href="{{route('medication.new')}}">
                            <i class="fa fa-plus"></i>
                            New Medication
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
                                    <th>Cow</th>
                                    <th>Vet/Company</th>
                                    <th>Contact</th>
                                    <th>Medicine/Vaccine</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Amount(Kes)</th>
                                    <th>Next Appointment</th>
                                    <th>Vet Remarks</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date</th>
                                    <th>Cow</th>
                                    <th>Vet/Company</th>
                                    <th>Contact</th>
                                    <th>Medicine/Vaccine</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Amount(Kes)</th>
                                    <th>Next Appointment</th>
                                    <th>Vet Remarks</th>
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
            ajax: '{{ route('list-medications') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'date', name: 'date' },
                { data: 'cow', name: 'cow' },
                { data: 'vet', name: 'vet' },
                { data: 'contact', name: 'contact' },
                { data: 'medicine_name', name: 'medicine_name' },
                { data: 'unit', name: 'unit' },
                { data: 'quantity', name: 'quantity' },
                { data: 'amount', name: 'amount' },
                { data: 'next_appointment', name: 'next_appointment' },
                { data: 'remarks', name: 'remarks' },
                { data: 'description', name: 'description' },
                { data: 'user', name: 'user' },
                { data: 'action'},
            ]
        });
    });
</script>
@endsection