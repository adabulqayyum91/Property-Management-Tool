<table id="venturesList" class="table box-shadow table-bordered" style="width:100%">
    <thead class="bg-active">
    <tr>
        <th>Select</th>
        <th>Venture Name</th>
        <th>Venture ID</th>

    </tr>
    </thead>
    <tbody>
    @foreach($ventures as $venture)
        <tr>
            <td>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="venture-radio" type="radio" onchange="getVentureOwnerUsers()" id="gridCheck" value="{{$venture->id}}">

                    </div>
                </div>
            </td>
            <td>{{$venture->venture_name}}</td>
            <td>{{$venture->venture_automated_id}}</td>
        </tr>
    @endforeach

    </tbody>
</table>
<div id="venture-links">
    {!! $ventures->links() !!}
</div>