{{--=========================================================================================
Description:  upload Document View
* Created by PhpStorm.
 * User: Zahra
 * Date: 4/7/2020
 * Time: 5:08 PM
----------------------------------------------------------------------------------------
========================================================================================== --}}

<div class="tabs-section" style="border:1px solid #eee;">
    <div class="row">

        <div class="col-md-9">
            <div class="tab-content" id="myTabContent">

                <div class="row text-center">
                    @foreach($currentVentureList->medias()->get() as $file)
                        <div class="col-md-4 media-box">
                            <a href="{{ asset('uploads/ventures/'.$file->file_name) }}" download
                               style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <h6>{{$file->title}}</h6>
                                <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                            </a>
                                <span class="media-delete">
                                  <button type="button"
                                          data-file="{{$file->id}}"
                                          class="btn btn-xs btn-warning"><i
                                              class="fa fa-trash"></i></button>
                                </span>


                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
