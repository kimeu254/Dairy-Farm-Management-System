@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Health Status</h4>
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
                <a href="#">Health Status</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Health Status</h4>
                        <button class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            <i class="fa fa-plus"></i>
                            Add Health Status
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
                                        New Health Status
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
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="optionsRadios" id="calf01" value="calf" onclick="Check();">
                                                        <span class="form-radio-sign">Calf</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" id="cattle02" style="display: none">
                                                <div class="form-group form-group-default">
                                                    <label>Cattle *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="cattle_id" required>
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
                                                    <select class="form-control" id="formGroupDefaultSelect" name="calf_id" required>
                                                        <option value="">-----Select-----</option>
                                                        @foreach($calves as $calf)
                                                        <option value="{{$calf->id}}">{{$calf->calf_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Health Status *</label>
                                                    <input id="health_status" type="text" name="health_status" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Body Fitness *</label>
                                                    <input id="body_fitness" type="text" name="body_fitness" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Description *</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Remarks *</label>
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
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
                                    <th>Date</th>
                                    <th>Calf No.</th>
                                    <th>Health Status</th>
                                    <th>Body Fitness</th>
                                    <th>Description</th>
                                    <th>Remarks</th>
                                    <th>Added By</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date</th>
                                    <th>Calf No.</th>
                                    <th>Health Status</th>
                                    <th>Body Fitness</th>
                                    <th>Description</th>
                                    <th>Remarks</th>
                                    <th>Added By</th>
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
            ajax: '{{ route('list-status') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'date', name: 'date' },
                { data: 'cow', name: 'cow' },
                { data: 'health_status', name: 'health_status' },
                { data: 'body_fitness', name: 'body_fitness' },
                { data: 'description', name: 'description' },
                { data: 'remarks', name: 'remarks' },
                { data: 'user', name: 'user' },
            ]
        });
    });

    $("#btnAdd").click(function(){
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#addRowModal').modal('show'); // show bootstrap modal
        $('.modal-title').text('New Health Status'); // Set Title to Bootstrap modal title
    });

    $(document).ready(function(){
        $.myFunction = function(){ 
            $('#progress').show();
            var url;
            var t;
            if(save_method == 'add')
            {
                url = "status";
                t = "POST";
            }
            else
            {
            var id = document.getElementById('id').value;
                url = "status/" + id;
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
                        text: "Health Status Updated successfully.",
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
 function edit_status(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url : "status/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data[0].id);
                $('[name="date"]').val(data[0].date);
                $('[name="cattle_id"]').val(data[0].cattle_id);
                $('[name="calf_id"]').val(data[0].calf_id);
                $('[name="health_status"]').val(data[0].health_status);
                $('[name="description"]').val(data[0].description);
                $('[name="body_fitness"]').val(data[0].body_fitness);
                $('[name="remarks"]').val(data[0].remarks);
                $('[name="user_id"]').val(data[0].user_id);
                $('#addRowModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Breed'); // Set title to Bootstrap modal title
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
    function Check() {
        if (document.getElementById('cattle01').checked) {
            document.getElementById('calf02').style.display = 'none';
            document.getElementById('cattle02').style.display = 'block';
        } 
        else if(document.getElementById('calf01').checked){
            document.getElementById('calf02').style.display = 'block';
            document.getElementById('cattle02').style.display = 'none';
        }
    }  
</script>
@endsection