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
                <a href="#">Cows</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Cattle</h4>
                        <button class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            <i class="fa fa-plus"></i>
                            Add Cattle
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
                                                    <input id="cattle_no" type="text" name="cattle_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Breed *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="breed_id" required>
                                                        <option value="">-----Select-----</option>
                                                        @foreach($breeds as $breed)
                                                        <option value="{{$breed->id}}">{{$breed->title}}</option>
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
                                                    <label>Farm Entry Date *</label>
                                                    <input id="farm_entry_date" type="date" name="farm_entry_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Purchase Amount (kes) *</label>
                                                    <input id="purchase_amt" type="number" name="purchase_amt" class="form-control" required>
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
                                    <th>Cattle No.</th>
                                    <th>Breed</th>
                                    <th>Stall</th>
                                    <th>Weight(kgs)</th>
                                    <th>Farm Entry Date</th>
                                    <th>Current Value(kes)</th>
                                    <th>Status</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Cattle No.</th>
                                    <th>Breed</th>
                                    <th>Stall</th>
                                    <th>Weight(kgs)</th>
                                    <th>Farm Entry Date</th>
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
            ajax: '{{ route('list-cattle') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'cattle_no', name: 'cattle_no' },
                { data: 'breed', name: 'breed' },
                { data: 'stall', name: 'stall' },
                { data: 'weight', name: 'weight' },
                { data: 'farm_entry_date', name: 'farm_entry_date' },
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
        $('.modal-title').text('New Cattle'); // Set Title to Bootstrap modal title
    });

    $(document).ready(function(){
        $.myFunction = function(){ 
            $('#progress').show();
            var url;
            var t;
            if(save_method == 'add')
            {
                url = "cattle";
                t = "POST";
            }
            else
            {
            var id = document.getElementById('id').value;
                url = "cattle/" + id;
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
                        text: "Cattle Updated successfully.",
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
    function edit_cattle(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url : "cattle/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data[0].id);
                $('[name="cattle_no"]').val(data[0].cattle_no);
                $('[name="breed_id"]').val(data[0].breed_id);
                $('[name="stall_id"]').val(data[0].stall_id);
                $('[name="weight"]').val(data[0].weight);
                $('[name="farm_entry_date"]').val(data[0].farm_entry_date);
                $('[name="purchase_amt"]').val(data[0].purchase_amt);
                $('[name="current_value"]').val(data[0].current_value);
                $('[name="comments"]').val(data[0].comments);
                $('[name="status"]').val(data[0].status);
                $('#addRowModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Cattle'); // Set title to Bootstrap modal title
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