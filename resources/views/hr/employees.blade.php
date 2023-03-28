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
                        <h4 class="card-title">Employees</h4>
                        <button class="btn btn-primary btn-round ml-auto" id="btnAdd">
                            <i class="fa fa-plus"></i>
                            Add Employee
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
                                        New Employee
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
                                                    <label>First Name *</label>
                                                    <input id="fname" type="text" name="fname" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Last Name *</label>
                                                    <input id="lname" type="text" name="lname" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>ID Number *</label>
                                                    <input id="id_no" type="number" name="id_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Phone Number *</label>
                                                    <input id="phone" type="number" name="phone" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Email </label>
                                                    <input id="email" type="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Town </label>
                                                    <input id="town" type="text" name="town" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Address </label>
                                                    <textarea class="form-control" name="address" id="address" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Work Description *</label>
                                                    <textarea class="form-control" name="work_description" id="work_description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Salary (kes) *</label>
                                                    <input id="salary" type="number" name="salary" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Rate *</label>
                                                    <input id="rate" type="text" name="rate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Comments </label>
                                                    <textarea class="form-control" name="comments" id="comments" rows="5"></textarea>
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
                                    <th>Name</th>
                                    <th>ID NO.</th>
                                    <th>Phone</th>
                                    <th>Work Description</th>
                                    <th>Salary(Kes)</th>
                                    <th>Rate</th>
                                    <th>Added By</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>ID NO.</th>
                                    <th>Phone</th>
                                    <th>Work Description</th>
                                    <th>Salary(Kes)</th>
                                    <th>Rate</th>
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
            ajax: '{{ route('list-employees') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'id_no', name: 'id_no' },
                { data: 'phone', name: 'phone' },
                { data: 'work_description', name: 'work_description' },
                { data: 'salary', name: 'salary' },
                { data: 'rate', name: 'rate' },
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
                url = "employee";
                t = "POST";
            }
            else
            {
            var id = document.getElementById('id').value;
                url = "employee/" + id;
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
                        text: "Employee Updated successfully.",
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
    function edit_employee(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url : "employee/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data[0].id);
                $('[name="fname"]').val(data[0].fname);
                $('[name="lname"]').val(data[0].lname);
                $('[name="id_no"]').val(data[0].id_no);
                $('[name="phone"]').val(data[0].phone);
                $('[name="email"]').val(data[0].email);
                $('[name="address"]').val(data[0].address);
                $('[name="town"]').val(data[0].town);
                $('[name="work_description"]').val(data[0].work_description);
                $('[name="salary"]').val(data[0].salary);
                $('[name="rate"]').val(data[0].rate);
                $('[name="comments"]').val(data[0].comments);
                $('[name="status"]').val(data[0].status);
                $('#addRowModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title
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