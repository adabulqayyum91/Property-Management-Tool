@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
Venture Ownership Details | Admin Panel
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
                                <div class="dashboard-list">
                                    <div class="dashboard-message bdr clearfix ">
                                        <div class="tab-box-2">
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>
                                                    Venture Ownership Data 
                                                    <small>({{$venture->venture_automated_id}})</small>
                                                </span>
                                            </div>
                                            <form method="POST" action="{{url('admin/ownership-update')}}">
                                                {{@csrf_field()}}
                                                <table id="myTable" class="table">
                                                    <thead>
                                                        <th>User ID</th>
                                                        <th>Onwership Start Sequence</th>
                                                        <th>Ownership End Sequence</th>
                                                        <th>Amount Paid</th>
                                                        <th>Amount Sold</th>
                                                        <th>Ownership Begin Date</th>
                                                        <th>Ownership End Date</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($ventureOwnerships as $data)
                                                        @if(!is_null($data->user))
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        <tr>
                                                            <td>{{$data->user->member_automated_id}}</td>
                                                            <td>
                                                                <input type="text" id="ownership_sequence_start{{$data->id}}" value="{{$data->ownership_sequence_start}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="ownership_sequence_end{{$data->id}}" value="{{$data->ownership_sequence_end}}">
                                                            </td>
                                                            <td>
                                                                {{formatCurrency($data->amount_paid)}}
                                                            </td>
                                                            <td>
                                                                {{formatCurrency($data->amount_sold)}}
                                                            </td>
                                                            <td>
                                                                {{formatMDY($data->ownership_begin_date)}}
                                                            </td>
                                                            <td>
                                                                @if(is_null($data->ownership_end_date))
                                                                N/A
                                                                @else
                                                                {{formatMDY($data->ownership_end_date)}}
                                                                @endif    
                                                            </td>
                                                            <td class="nowrap">
                                                                <button 
                                                                onclick="updateRowData({{$data->id}})"type="button"
                                                                class="btn btn-warning">
                                                                Update
                                                            </button>
                                                            <a  class="btn btn-linked btn-danger box-shadow deleteRecord" data-id="{{ $data->id }}">
                                                                Delete
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

        $(".deleteRecord").click(function(){
            var id = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax(
                    {
                        url: "{{url('admin/ownership-delete/')}}/"+id,
                        type: 'GET',
                        success: function (response){
                            if(response.status == true){
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                    )
                                location.reload(true);
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
            })

        });
    });
</script>
@endsection
