
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
        <div class="option-bar">
            <h6 class="mb-0">There are {{$surveys->total()}} results found.</h6>
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
        <th class="text-center">Subject</th>
        <th class="text-center">Venture</th>
        <th class="text-center">Due Date</th>
        <th class="text-center">Result</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($surveys as $data)
            @if($data->venture)
                <tr style="background-color:{{ $data->read_status ? 'lightgrey':'white' }}">
                    <td class="text-center">
                        <input type="checkbox" class="displayCheckbox" name="surveys_id[]" value="{{ $data->id }}">
                    </td>
                    <td class="text-center">{{ !is_null($data->subject) ? $data->subject : 'N/A'}}</td>
                    <td class="text-center">{{ !is_null($data->venture_id) ? $data->venture->venture_name : 'N/A'}}</td>
                    <td class="text-center">{{ !is_null($data->due_date) ? Helper::carbonParseFormat($data->due_date) : 'N/A'}}</td>
                    <td class="text-center">
                        @if($data->result_sent==1)
                            <label class="btn-success result_sent">Sent</label>
                        @else
                            <label class="btn-danger result_sent">Pending</label>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{url('/manager/surveys/show/'.$data->id)}}" style="min-width: 25px">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a href="{{url('/manager/surveys/files/'.$data->id)}}" style="min-width: 25px">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </a>
                        <a  type="button" class="btn btn-warning" href="{{url('/manager/surveys/result-send/'.$data->id)}}">
                            Send
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
{!! $surveys->links() !!}