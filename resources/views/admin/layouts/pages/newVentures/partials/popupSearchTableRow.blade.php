{{-- =========================================================================================
Description:  New Venture Listing table Block For Admin Dashboard
* Created by PhpStorm.
 * User: Zahra
* Date: 4/11/2020
 * Time: 9:27 AM
----------------------------------------------------------------------------------------
========================================================================================== --}}
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
        <th>Select</th>
        <th>Venture Name</th>
        <th>Venture ID</th>

    </tr>
    </thead>
    <tbody>
    @if(count($ventures)!=0)

    @foreach($ventures as $venture)
        <tr>
            <td>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="venture-radio" type="radio" id="gridCheck"
                               value="{{$venture->venture_automated_id  }}" {{$venture->VentureExist() == true?'disabled':''}}>

                    </div>
                </div>
            </td>
            <td>  <span data-toggle="tooltip" data-placement="top"  title="{{$venture->venture_name}} is already taken">
                                        {{$venture->venture_name}}
                                    </span></td>
            <td>{{$venture->venture_automated_id}}</td>
        </tr>
    @endforeach
    @endif


    </tbody>
</table>
