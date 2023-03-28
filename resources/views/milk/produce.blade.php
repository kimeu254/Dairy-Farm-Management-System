@extends('layouts.app')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Milk Production</h4>
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
                <a href="#">Milk</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Milk Production</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Milk Produce</h4>
                        <button class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            <i class="fa fa-plus"></i>
                            Add Milk Produce
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
                                        New Produce
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
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Cattle No *</label>
                                                    <select class="form-control" id="formGroupDefaultSelect" name="cattle_id" required>
                                                        <option value="">-----Select-----</option>
                                                        @foreach($cattles as $cattle)
                                                        <option value="{{$cattle->id}}">{{$cattle->cattle_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Date *</label>
                                                    <input id="date" type="date" name="date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Morning Amount (ltrs) *</label>
                                                    <input id="morning_amt" type="number" name="morning_amt" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Noon Amount (ltrs) *</label>
                                                    <input id="noon_amt" type="number" name="noon_amt" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Evening Amount (ltrs) *</label>
                                                    <input id="evening_amt" type="number" name="evening_amt" class="form-control">
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
                                    <th>Date</th>
                                    <th>Morning Amount(Ltrs)</th>
                                    <th>Noon Amount(Ltrs)</th>
                                    <th>Evening Amount(Ltrs)</th>
                                    <th>Total</th>
                                    <th>Added By Type</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Cattle No.</th>
                                    <th>Date</th>
                                    <th>Morning Amount(Ltrs)</th>
                                    <th>Noon Amount(Ltrs)</th>
                                    <th>Evening Amount(Ltrs)</th>
                                    <th>Added By Type</th>
                                    <th>Total</th>
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
            ajax: '{{ route('list-milk') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'cattle', name: 'cattle' },
                { data: 'date', name: 'date' },
                { data: 'morning_amt', name: 'morning_amt' },
                { data: 'noon_amt', name: 'noon_amt' },
                { data: 'evening_amt', name: 'evening_amt' },
                { data: 'total', name: 'total' },
                { data: 'user', name: 'user' },
                { data: "action" }
            ]
        });
    });

    $("#btnAdd").click(function(){
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#addRowModal').modal('show'); // show bootstrap modal
        $('.modal-title').text('New Produce'); // Set Title to Bootstrap modal title
    });

    $(document).ready(function(){
        $.myFunction = function(){ 
            $('#progress').show();
            var url;
            var t;
            if(save_method == 'add')
            {
                url = "milk";
                t = "POST";
            }
            else
            {
            var id = document.getElementById('id').value;
                url = "milk/" + id;
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
                        text: "Milk Updated successfully.",
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
    function edit_milk(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url : "milk/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data[0].id);
                $('[name="cattle_id"]').val(data[0].cattle_id);
                $('[name="date"]').val(data[0].date);
                $('[name="morning_amt"]').val(data[0].morning_amt);
                $('[name="noon_amt"]').val(data[0].noon_amt);
                $('[name="evening_amt"]').val(data[0].evening_amt);
                $('[name="total"]').val(data[0].total);
                $('#addRowModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Produce'); // Set title to Bootstrap modal title
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