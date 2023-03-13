@extends('web.layouts.partials.app')
@section('page_title')
Transaction History| Property Management Tool
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
            @include('web.layouts.partials.sideBar')
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
                                    <form method="POST" action="{{url('/transaction-hisotry')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Venture Name:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" value="{{$venture_name}}" placeholder="Venture Name" name="venture_name">

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">From:</label>
                                                <div class="form-group">
                                                    <div class="datepicker0 date input-group p-0 shadow-sm">
                                                        <input type="text" placeholder="Date"
                                                        class="form-control box-shadow"
                                                        name="from"
                                                        value="{{$from}}"
                                                        >
                                                        <div class="input-group-append"><span
                                                            class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">To:</label>
                                                <div class="form-group">
                                                    <div class="datepicker0 date input-group p-0 shadow-sm">
                                                        <input type="text" placeholder="Date"
                                                        class="form-control box-shadow"
                                                        name="to"
                                                        value="{{$to}}"
                                                        >
                                                        <div class="input-group-append"><span
                                                            class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" required>--}}
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="submit" class="btn btn-sm btn-theme"
                                                value="Submit" style="margin-top:35px; border-radius: 50px;">
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="tab-box-2">
                                        <label><b>Total Rental Income:</b> {{formatCurrency($totalRentalIncome)}}</label>
                                        <hr>
                                        <table id="myTable" class="table">
                                            <thead>
                                                <th>Date</th>
                                                <th>Venture</th>
                                                <th>Transaction Type</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                            </thead>
                                            <tbody>
                                                @foreach($lookups as $data)
                                                <tr>
                                                    <td>
                                                        {{formatMDY($data['date'])}}
                                                    </td>
                                                    <td>
                                                        {{$data['venture']['venture_name']}}
                                                    </td>
                                                    <td>
                                                        {{$data['label']}}
                                                    </td>
                                                    <td>
                                                        $
                                                        <span class="float-right">
                                                         {{formatCurrencyWoSign($data['debit'])}}
                                                     </span>
                                                 </td>
                                                 <td>
                                                    $
                                                    <span class="float-right">
                                                     {{formatCurrencyWoSign($data['credit'])}}
                                                 </span>
                                             </td>
                                         </tr>
                                         @endforeach
                                     </tbody>
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

@endsection
@section('script')
<script type="text/javascript">

    $(document).ready( function () {
        $('#myTable').DataTable({
                // TODO: For futrue use.
                // scrollX:true
                "order": [[ 0, "desc" ]]
            });
        $('.datepicker0').datepicker({
            format: 'mm/dd/yyyy'
        });
    });
</script>
@endsection
