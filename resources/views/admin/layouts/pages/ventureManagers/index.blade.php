@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Venture Managers | Admin Panel
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
                                                <button data-toggle="modal" data-target="#add-pm" style="margin-top:-10px" class="btn btn-warning float-right">Add PM</button>
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>
                                                        Venture Managers 
                                                        <small>({{$venture->venture_automated_id}})</small>
                                                    </span>
                                                </div>
                                                <form method="POST" action="{{url('admin/ownership-update')}}">
                                                    {{@csrf_field()}}
                                                    <table id="myTable" class="table">
                                                        <thead>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Actions</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($ventureManagers as $data)
                                                                @if(!is_null($data->user))
                                                                    <tr>
                                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                                        <td>{{$data->user->first_name}}</td>
                                                                        <td>{{$data->user->last_name}}</td>
                                                                        <td>
                                                                            <a  href="{{url('admin/venture-managers/delete/'.$data->id)}}" class="btn btn-danger">
                                                                                Remove
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Property Managers?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/admin/venture-managers/store')}}">
                    @csrf
                    <div class="modal-body">
                        <label>Managers:</label>
                        <select class="form-control" name="manager_id" required>
                            @foreach($managers as $m)
                                <option value="{{$m->id}}">{{$m->first_name}} {{$m->last_name}}</option>
                            @endforeach
                            <input type="hidden" name="venture_id" value="{{$venture->id}}">
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Add</button>
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
  $(document).ready( function () {
    $('#myTable').DataTable({
        // TODO: For futrue use.
        // scrollX:true
    });
  });
</script>
@endsection
