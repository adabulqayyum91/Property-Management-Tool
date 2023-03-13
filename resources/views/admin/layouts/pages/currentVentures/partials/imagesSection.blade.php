@foreach($currentVentureList->medias()->where('type', 'IMAGE')->get() as $image)
    <li class="col-md-2 image-box">
        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ $currentVentureList->venture->venture_name }}" class="img-responsive image-popup mb-4" style="width: 100%; height: 140px;" >
        <span class="image-delete">
          <button type="button"
                  data-file="{{$image->id}}"
                  class="btn btn-xs btn-warning"><i
                  class="fa fa-trash"></i></button>
        </span>
    </li>
@endforeach
