<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
        <div class="option-bar">
            <h6 class="mb-0">There are {{count($users)}} results found.</h6>
        </div>
    </div>
</div>
<table id="example" class="table box-shadow table-bordered" style="width:100%">
    <thead class="bg-active">
    <tr>
        <th>Select</th>
        <th>User Name</th>
        <th>User ID</th>

    </tr>
    </thead>
        <tbody>
        @if(count($users)>0)
            @foreach($users as $user)
                @if(!is_null($user->role->role) && $user->role->role->name !='Admin')
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="user-radio" type="radio" id="gridCheck" value="{{$user->id}}">

                                </div>
                            </div>
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->member_automated_id}}</td>
                    </tr>
                @endif

            @endforeach
        @else
            <tr>
                <td colspan="3" class="text-center">
                    No Data Found
                </td>
            </tr>
        @endif
    </tbody>
</table>
<div id="user-links">
    {!! $users->links() !!}
</div>