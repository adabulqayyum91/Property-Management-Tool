@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Venture Transactions | Admin Panel
@endsection
@section('content')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
        }
        .btn-faqs{
            margin-top: 35px;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">       
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('success'))
                                      <div class="alert alert-success">
                                          <strong>SUCCESS :</strong> {{ session('success') }}
                                      </div>
                                    @endif
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <button data-toggle="modal" data-target="#add-pm" style="margin-top:-10px" class="btn btn-warning float-right">Add New</button>
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>
                                                        Venture Transactions 
                                                        <small>({{$venture->venture_automated_id}})</small>
                                                    </span>
                                                </div>
                                                <form method="POST" action="{{url('admin/ownership-update')}}">
                                                    {{@csrf_field()}}
                                                    <table id="myTable" class="table">
                                                        <thead>
                                                            <th>Member</th>
                                                            <th>Name</th>
                                                            <th>Type</th>
                                                            <th>Value</th>
                                                            <th>Date</th>
                                                            <th>Note</th>
                                                            <th>Actions</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($transactions as $data)
                                                                <tr>
                                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                                    <td>{{$data->user->first_name}} {{$data->user->last_name}}</td>
                                                                    <td>{{$data->label}}</td>
                                                                    <td>
                                                                        @if($data->type)
                                                                            Credit
                                                                        @else
                                                                            Debit
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{formatCurrency($data->value)}}
                                                                    </td>
                                                                    <td>
                                                                        {{formatMDY($data->date_time)}}
                                                                    </td>
                                                                    <td>
                                                                        {{valueOrNa($data->note)}}
                                                                    </td>
                                                                    <td>
                                                                        <a  href="#" data-toggle="modal" data-target="#edit-tr" class="btn btn-warning"
                                                                        onclick="setEditValues({{$data->id}},{{$data->ownership_id}},'{{$data->label}}',{{$data->type}},{{$data->value}},'{{formatMDY($data->date_time)}}','{{$data->note}}')">
                                                                            Edit
                                                                        </a>
                                                                        <a  href="{{url('admin/venture-transactions/delete/'.$data->id)}}" class="btn btn-danger">
                                                                            Remove
                                                                        </a>
                                                                    </td>
                                                                </tr>    
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-pm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Transaction?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/admin/venture-transactions/store')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="venture_id" value="{{$venture->id}}">
                        <label>Members:</label>
                        <select class="form-control" name="ownership_id" required>
                            @foreach($ventureOwnership as $m)
                                <option value="{{$m->id}}">
                                    {{$m->user->first_name}} {{$m->user->last_name}} 
                                    ({{$m->ownership_sequence_start}}:{{$m->ownership_sequence_end}}) 
                                    ({{$m->ownership_begin_date}} - {{$m->deleted_at?Helper::carbonParseFormat($m->deleted_at):'continue..'}})</option>
                            @endforeach
                        </select>
                        <label>Name:</label>
                        <select class="form-control" name="label" required>
                            <option value="Purchase">Purchase</option>
                            <option value="Closing Cost">Closing Cost</option>
                            <option value="Capital Reserve">Capital Reserve</option>
                            <option value="Sale">Sale</option>
                        </select>
                        <label>Type:</label>
                        <select class="form-control" name="type" required>
                            <option value="0">Debit</option>
                            <option value="1">Credit</option>
                        </select>
                        <label>Amount:</label>
                        <input type="number" name="value" step="0.01" class="form-control" required/>
                        <label>Date</label>
                        <div class="form-group">
                            <div class="datepicker0 date input-group p-0 shadow-sm">
                                <input type="text" placeholder="Date"
                                       class="form-control box-shadow"
                                       name="date_time"
                                       style="width:50%" 
                                       required>
                                <div class="input-group-append"><span
                                            class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <label>Note:</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Add</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-tr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaction?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/admin/venture-transactions/update')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id" value="">
                        <label>Members:</label>
                        <select class="form-control" id="edit_ownership_id" name="ownership_id" required>
                            @foreach($ventureOwnership as $m)
                                <option value="{{$m->id}}">
                                    {{$m->user->first_name}} {{$m->user->last_name}} 
                                    ({{$m->ownership_sequence_start}}:{{$m->ownership_sequence_end}}) 
                                    ({{$m->ownership_begin_date}} - {{$m->deleted_at?Helper::carbonParseFormat($m->deleted_at):'continue..'}})</option>
                            @endforeach
                        </select>
                        <label>Name:</label>
                        <select class="form-control" id="edit_label" name="label" required>
                            <option value="Purchase">Purchase</option>
                            <option value="Closing Cost">Closing Cost</option>
                            <option value="Capital Reserve">Capital Reserve</option>
                            <option value="Sale">Sale</option>
                        </select>
                        <label>Type:</label>
                        <select class="form-control" id="edit_type" name="type" required>
                            <option value="0">Debit</option>
                            <option value="1">Credit</option>
                        </select>
                        <label>Amount:</label>
                        <input type="number" id="edit_value" name="value" step="0.01" class="form-control" required/>
                        <label>Date</label>
                        <div class="form-group">
                            <div class="datepicker0 date input-group p-0 shadow-sm">
                                <input type="text" placeholder="Date"
                                       class="form-control box-shadow"
                                       id="edit_date_time"
                                       name="date_time"
                                       style="width:50%" 
                                       required>
                                <div class="input-group-append"><span
                                            class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <label>Note:</label>
                        <textarea class="form-control" id="edit_note" name="note"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Update</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>

@endsection

@section('javaScript')
<script type="text/javascript">

    function updateRowData(ownership_id){
        var formData={
            id:ownership_id,
            ownership_sequence_start:$('#ownership_sequence_start'+ownership_id).val(),
            ownership_sequence_end:$('#ownership_sequence_end'+ownership_id).val()
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/ownership-update') }}",
            data: formData,
            success: function (response) {
                if(response.status == true){
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toastr.error(item);
                });
            }
        });
    }
    function setEditValues(edit_id,edit_ownership_id,edit_label,edit_type,edit_value,edit_date_time,edit_note){
        console.log(edit_id,edit_ownership_id,edit_label,edit_type,edit_value,edit_date_time,edit_note)

        $('#edit_id').val(edit_id);
        $('#edit_ownership_id').val(edit_ownership_id);
        $('#edit_label').val(edit_label);
        $('#edit_type').val(edit_type);
        $('#edit_value').val(edit_value);
        $('#edit_date_time').val(edit_date_time);
        $('#edit_note').val(edit_note);
    }
  $(document).ready( function () {
    $('#myTable').DataTable({
        // TODO: For futrue use.
        // scrollX:true
    });
    $('.datepicker0').datepicker({
        format: 'mm/dd/yyyy'
    });
  });
</script>
@endsection
