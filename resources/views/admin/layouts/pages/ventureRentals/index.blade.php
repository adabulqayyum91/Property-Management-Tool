@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
Venture Rental Details | Admin Panel
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
                                        <button data-toggle="modal" data-target="#add-rent" style="margin-top:-10px" class="btn btn-warning float-right">Add</button>
                                        <div class="clearfix mb-30 comments-tr"> <span>Venture Rental Data <small>({{$venture->venture_automated_id}})</small></span></div>
                                        <table id="myTable">
                                            <thead>
                                                <th>Date Rent Collected</th>
                                                <th>Rent Due</th>
                                                <th>Amount Collected</th>
                                                <th>Rent Past Due</th>
                                                <th>Fees and Other Income</th>
                                                <th>Management Fee</th>
                                                <th>Repairs and Other Expenses</th>
                                                <th>Net Income</th>
                                                <th>Action</th>
                                            </thead>
                                            <body>
                                                @foreach($ventureRentals as $data)
                                                <tr>
                                                    <td>{{formatMDY($data->date_rent_collected)}}</td>
                                                    <td>
                                                        {{formatCurrency($data->rent_due)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->amount_collected)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->rent_past_due)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->fees_and_other_income)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->management_fee)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->repairs_and_other_expenses)}}
                                                    </td>
                                                    <td>
                                                        {{formatCurrency($data->net_income)}}
                                                    </td>
                                                    <td>
                                                        <a  href="{{url('/admin/venture-rental/delete/'.$data->id)}}" class="btn btn-danger">
                                                            Remove
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </body>
                                        </table>
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
<div class="modal fade" id="add-rent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Rental Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('/admin/venture-rental/store')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="venture_id" value="{{$venture->id}}">
                    <label>Date Rent Collected</label>
                    <div class="form-group">
                        <div class="datepicker0 date input-group p-0 shadow-sm">
                            <input type="text" placeholder="Date"
                            class="form-control box-shadow"
                            id="edit_date_time"
                            name="date_rent_collected"
                            style="width:50%" 
                            required>
                            <div class="input-group-append"><span
                                class="input-group-text"><i
                                class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <label>Rent Due</label>
                    <input type="number" name="rent_due" class="form-control" value="0.00" step="0.01" required/>
                    <label>Amount Collected</label>
                    <input type="number" name="amount_collected" class="form-control" value="0.00" step="0.01" required/>
                    <label>Rent Past Due</label>
                    <input type="number" name="rent_past_due" class="form-control" value="0.00" step="0.01" required/>
                    <label>Fees & Other Income</label>
                    <input type="number" name="fees_and_other_income" class="form-control" value="0.00" step="0.01" required/>
                    <label>Managment Fees</label>
                    <input type="number" name="management_fee" class="form-control" value="0.00" step="0.01" required/>
                    <label>Repair & Other expenses</label>
                    <input type="number" name="repairs_and_other_expenses" class="form-control" value="0.00" step="0.01" required/>
                        {{-- <label>Net income</label>
                        <input type="number" name="net_income" class="form-control" value="0.00" step="0.01" required/> --}}

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
      $(document).ready( function () {
        $('#myTable').DataTable({
            aaSorting: [],
        });
        $('.datepicker0').datepicker({
            format: 'mm/dd/yyyy',
        });
    });
</script>
@endsection
