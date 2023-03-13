@foreach($survey->medias()->where('type', 'IMAGE')->get() as $image)
    <li class="col-md-2 image-box">           
    	<a href="{{ asset('uploads/surveys/'.$image->file_name) }}" download>
            {{-- <i class="fa fa-download" aria-hidden="true"></i> --}}
        	<img src="{{ asset('uploads/surveys/'.$image->file_name) }}" alt="{{ $survey->subject }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >
        </a>
        

        <span class="image-delete">
            <button type="button"
                    data-file="{{$image->id}}"
                    class="btn btn-xs btn-warning">
                    <i class="fa fa-trash"></i>
            </button>
        </span>                                     
    </li>
@endforeach