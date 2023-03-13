@foreach($currentVenture->medias()->where('type', 'IMAGE')->get() as $image)
    <li class="col-md-2">
        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ $currentVenture->venture_name }}" class="img-responsive image-popup mb-4" style="width: 100%; height: 140px;" >
    </li>
@endforeach