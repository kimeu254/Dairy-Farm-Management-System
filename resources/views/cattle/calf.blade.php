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
                        <h4 class="card-title">Calves</h4>
                        <button class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            <i class="fa fa-plus"></i>
                            Add Calf
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        New Cattle
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small"></p>
                                    <form id="form" method="POST">
                                        @csrf
                                        <input type="hidden" id="id" name="id">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Cattle ID *</label>
                                                    <input id="calf_no" type="text" name="calf_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Parent *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="parent_id" required>
                                                        <option value="">-----Select-----</option>
                                                        @foreach($parents as $parent)
                                                        <option value="{{$parent->id}}">{{$parent->cattle_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Stall *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="stall_id" required>
                                                        <option value="">-----Select-----</option>
                                                        @foreach($stalls as $stall)
                                                        <option value="{{$stall->id}}">{{$stall->stall_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Weight (kgs) *</label>
                                                    <input id="weight" type="number" name="weight" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Date of Birth *</label>
                                                    <input id="birth_date" type="date" name="birth_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Insemination Type *</label>
                                                    <input id="insemination_type" type="text" name="insemination_type" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Current Value (kes) *</label>
                                                    <input id="current_value" type="number" name="current_value" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Comments *</label>
                                                    <textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Status *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="status" required>
                                                        <option value="">-----Select-----</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Calf No.</th>
                                    <th>Parent</th>
                                    <th>Stall</th>
                                    <th>Weight(kgs)</th>
                                    <th>Birth Date</th>
                                    <th>Insemination Type</th>
                                    <th>Current Value(kes)</th>
                                    <th>Status</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Calf No.</th>
                                    <th>Parent</th>
                                    <th>Stall</th>
                                    <th>Weight(kgs)</th>
                                    <th>Birth Date</th>
                                    <th>Insemination Type</th>
                                    <th>Current Value(kes)</th>
                                    <th>Status</th>
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
            ajax: '{{ route('list-calves') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'calf_no', name: 'calf_no' },
                { data: 'cattle', name: 'cattle' },
                { data: 'stall', name: 'stall' },
                { data: 'weight', name: 'weight' },
                { data: 'birth_date', name: 'birth_date' },
                { data: 'insemination_type', name: 'insemination_type' },
                { data: 'current_value', name: 'current_value' },
                { data: 'status', name: 'status' },
                { data: "action" }
            ]
        });
    });

    $("#btnAdd").click(function(){
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#addRowModal').modal('show'); // show bootstrap modal
        $('.modal-title').text('New Calf'); // Set Title to Bootstrap modal title
    });

    $(document).ready(function(){
        $.myFunction = function(){ 
            $('#progress').show();
            var url;
            var t;
            if(save_method == 'add')
            {
                url = "calf";
                t = "POST";
            }
            else
            {
            var id = document.getElementById('id').value;
                url = "calf/" + id;
                t = "PUT";
            }
            // ajax adding data to database
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url,
                type: t,
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    //if success close modal and reload ajax table
                    reload_table();
                    $('#progress').hide();
                    $('#addRowModal').modal('hide');
                    new swal({      
                        icon: 'success',
                        text: "Calf Updated successfully.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    }); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // alert('Error adding / update data');
                    new swal({   title: "Error",   
                        text: "Error adding / updating data.",   
                        // timer: 1000,
                        type: "error",   
                        showConfirmButton: true 
                    });
                }
            }); 
        }
        $("#btnSave").click(function(){
            $.myFunction();
        });
    });

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

</script>
<script type="text/javascript">
    function edit_calf(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url : "calf/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data[0].id);
                $('[name="calf_no"]').val(data[0].calf_no);
                $('[name="parent_id"]').val(data[0].parent_id);
                $('[name="stall_id"]').val(data[0].stall_id);
                $('[name="weight"]').val(data[0].weight);
                $('[name="birth_date"]').val(data[0].birth_date);
                $('[name="insemination_type"]').val(data[0].insemination_type);
                $('[name="current_value"]').val(data[0].current_value);
                $('[name="comments"]').val(data[0].comments);
                $('[name="status"]').val(data[0].status);
                $('#addRowModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Calf'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // alert('Error get data from ajax');
            new swal({   title: "Error",   
                    text: "Error getting data from ajax.",   
                    timer: 2500,
                    type: "error",   
                    showConfirmButton: false 
                });
            }
        });
    }
</script>
@endsection