
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
        <div class="option-bar">
            <h6 class="mb-0">There are {{$communication->total()}} results found.</h6>
        </div>
    </div>
</div>
<table id="example" class="table box-shadow table-bordered" style="width:100%">
    <thead class="bg-active">
    <tr>
        <th class="text-center">
            <button class="btn">
                <i class="fa fa-trash" data-toggle="modal" data-target="#confirmBulkDelete" aria-hidden="true"></i>
            </button>
        </th>
        <th class="text-center">From</th>
        <th class="text-center">Subject</th>
        <th class="text-center">Venture</th>
        <th class="text-center">Date</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($communication as $data)
            @if($data->venture)
                <tr style="background-color:{{ $data->read_status ? 'lightgrey':'white' }}">
                    <td class="text-center">
                        <input type="checkbox" class="displayCheckbox" name="communication_id[]" value="{{ $data->id }}">
                    </td>
                    <td class="text-center">
                        {{ !is_null($data->from_user) ? $data->fromUser->first_name : 'N/A'}}
                    </td>
                    <td class="text-center">{{ !is_null($data->subject) ? $data->subject : 'N/A'}}</td>
                    <td class="text-center">{{ !is_null($data->venture_id) ? $data->venture->venture_name : 'N/A'}}</td>
                    <td class="text-center">{{ !is_null($data->created_at) ? Helper::carbonParseFormat($data->created_at) : 'N/A'}}</td>
                    <td class="text-center">
                        <a href="{{url('/manager/communication/show/'.$data->id)}}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
{!! $communication->links() !!}