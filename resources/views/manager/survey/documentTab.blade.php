<div class="tabs-section" style="border:1px solid #eee;">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">

                <div class="row text-center">
                    @foreach($survey->medias()->where('type', null)->get() as $file)
                        <div class="col-md-3 media-box">
                            <a href="{{ asset('uploads/surveys/'.$file->file_name) }}" download
                               style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <h6>{{!is_null($file->title)?$file->title:''}}</h6>
                                <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                            </a>

                            <span class="media-delete">
                                <button type="button"
                                        data-file="{{$file->id}}"
                                        class="btn btn-xs btn-warning">
                                        <i class="fa fa-trash"></i>
                                </button>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>