
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
        <div class="option-bar">
            <h6 class="mb-0">There are {{count($ventures)}} results found.</h6>
        </div>
    </div>
</div>
                        <table id="example" class="table box-shadow table-bordered" style="width:100%">
                            <thead class="bg-active">
                            <tr>
                                <th>#</th>
                                <th>Venture ID</th>
                                <th>Name</th>
                                <th>Target Amount</th>
                                <th>Market CAP</th>
                                <th>Source Type</th>
                                <th>Venture Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($ventures)!=0)
                            @foreach($ventures as $venture)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ !is_null($venture->venture_automated_id) ? $venture->venture_automated_id : '---'}}</td>
                                    <td>{{ !is_null($venture->venture_name) ? $venture->venture_name : ''}}</td>
                                    <td>{{ !is_null($venture->target_amount) ?  Config::get('constants.CURRENCY_SIGN').number_format($venture->target_amount , 2, ',', '.'): ''}}</td>
                                    <td>{{ !is_null($venture->initial_cap) ?  $venture->initial_cap.'%' : '0%'}}</td>
                                    <td>{{ !is_null($venture->venture_source_type) ?  $venture->venture_source_type : ''}}</td>
                                    <td>{{ !is_null($venture->venture_type) ?  $venture->venture_type : ''}}</td>
                                    <td>{{ !is_null($venture->venture_status) ?  $venture->venture_status : ''}}</td>
                                    <td style="white-space: nowrap;">
                                        <form action="{{route('ventures.edit',$venture->id)}}" method="GET">
                                            <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                        </form>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">

                                        <button class="btn btn-linked btn-danger box-shadow deleteRecord" data-id="{{ $venture->id }}"><i  class="fa fa-trash"></i></button>
                                        <a  title="Rental Details" 
                                            href="{{url('admin/venture-rental-detail/'.$venture->id)}}"target="_blank" 
                                            class="btn btn-linked btn-primary box-shadow">RD</a>
                                        <a  title="Ownership Details"
                                            href="{{url('admin/venture-ownership-detail/'.$venture->id)}}" 
                                            target="_blank" 
                                            class="btn btn-linked btn-info box-shadow">OD</a>
                                        <a  title="Property Managers"
                                            href="{{url('admin/venture-managers/'.$venture->id)}}" 
                                            target="_blank" 
                                            class="btn btn-linked btn-success box-shadow">PM</a>
                                        <a  title="Transactions"
                                            href="{{url('admin/venture-transactions/'.$venture->id)}}" 
                                            target="_blank" 
                                            class="btn btn-linked btn-danger box-shadow">TR</a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
