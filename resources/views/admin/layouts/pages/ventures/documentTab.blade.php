<div class="tabs-section" style="border:1px solid #eee;">


    <div class="row">
        <div class="col-md-3" style="border-right:1px solid #eee;">

            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">

                @foreach($documentTypes as $type)
                <li class="nav-item">
                    <a class="nav-link {{  $loop->iteration === 1 ? "active" : '' }}" id="{{$type->id }}-tab"
                        data-toggle="tab" href="#{{$type->id  }}" role="tab" aria-controls="{{$type->id  }}"
                        aria-selected="{{  $loop->iteration === 1 ? "true" : 'false' }}">{{$type->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-9">
                <div class="tab-content" id="myTabContent">
                    @foreach($documentTypes as $type)
                    <div class="tab-pane fade {{  $loop->iteration === 1 ? "show active" : '' }}" id="{{$type->id  }}"
                        role="tabpanel" aria-labelledby="{{$type->id}}-tab">
                        <h4 style="padding:14px 0;margin:0 0 22px;">{{$type->title }}</h4>
                        <div class="row text-center">
                            @php
                            if(isset($from) || isset($to)){
                                $documents =
                                $currentVenture->medias()->where('document_type_id',$type->id)->where('date_of_document_to_apply', '>', $from)->where('date_of_document_to_apply','<',$to)->get();
                            }else{
                                $documents = $currentVenture->medias()->where('document_type_id',$type->id)->get();
                            }

                            @endphp
                            @foreach($documents as $file)
                            <div class="col-md-4 media-box">
                                <a href="{{ asset('uploads/ventures/'.$file->file_name) }}" download
                                    style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <h6>{{$file->title}}</h6>
                                    <small>{{ \Carbon\Carbon::parse($file->date_of_document_to_apply)->format('m-d-Y') }}</small>
                                    <span class="media-delete">
                                        <button type="button" data-file="{{$file->id}}" class="btn btn-xs btn-warning"><i
                                            class="fa fa-trash"></i></button>
                                        </span>
                                        <span class="media-status">
                                            <input id="toggle-event" class="media-status-btn" data-file="{{$file->id}}"
                                            data-width="75" data-height="35" type="checkbox" data-on="Visible"
                                            data-off="Hidden" data-onstyle="info" data-offstyle="warning"
                                            data-toggle="toggle" {{  $file->visibility  == 'Visible' ? "checked" : "" }}>
                                        </span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- /.col-md-8 -->
            </div>

        </div>