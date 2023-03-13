@extends('web.layouts.partials.app')
@section('page_title')
    Survey Detail | Member Panel
@endsection
@section('content')
    <style>
        .media-box:hover .media-status, .media-box:hover .media-delete, .image-box:hover .image-delete{
            display: block;
        }            

        /* Style the Image Used to Trigger the Modal */
        .image-popup {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image-popup:hover {
            opacity: 0.7;
            transform: scale(1.1);
        }
        label{
            font-weight: bold;
        }
        .questionNo{
            font-weight:bold;
        }
        .radio-label-margin{
            margin-right: 15px;
            margin-left: 5px;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('success'))
                                      <div class="alert alert-success">
                                          <strong>SUCCESS :</strong> {{ session('success') }}
                                      </div>
                                    @endif
                                    @if(session()->has('danger'))
                                      <div class="alert alert-danger">
                                          <strong>Error :</strong> {{ session('danger') }}
                                      </div>
                                    @endif
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>Survey Details</span>
                                            </div>
                                            <label>Venture:</label>
                                            <input type="text" name="survey" value="{{$survey->venture->venture_name}}" class="form-control" required readonly/>
                                            <br><br>
                                            <label>Subject</label>
                                            <input type="text" value="{{$survey->subject}}" name="subject" class="form-control" required readonly/>
                                            <br><br>
                                            <label>Body</label>
                                            <textarea name="body" class="form-control" required="true" readonly>{{$survey->body}}</textarea>
                                            <br><br>
                                            <label class="form-label">Due Date :</label>
                                            <div class="form-group">
                                                <div class="datepicker mdp date input-group p-0 shadow-sm">
                                                    <input type="text" value="{{$survey->due_date}}" placeholder="Due Date" class="form-control box-shadow" name="due_date" required readonly/>
                                                    <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                </div>
                                            </div>
                                            <br>
                                            <label>Questions</label>
                                            <div id="questions">
                                                <form method="POST" action="{{url('/user/survey/store')}}">
                                                    @csrf()
                                                    <input type="hidden" name="survey_id" value="{{$survey->id}}">
                                                    @foreach($questions as $key=> $data)
                                                        <p><span class="questionNo">Q{{$key+1}})</span> {{$data->question}}</p>
                                                        @foreach($data->options as $option)
                                                            <input type="radio" class="" name="pickedOption{{$key+1}}" value="{{$option->id}}" required/><label class="radio-label-margin">{{$option->value}}</label>
                                                        @endforeach
                                                        <br><br><br>
                                                    @endforeach
                                                    <div class="clearfix mb-30 comments-tr"><span>Pictures <small>(Downloadable on click)</small></span></div>
                                                    <div class="row">
                                                        @foreach($survey->medias()->where('type', 'IMAGE')->get() as $image)
                                                            <div class="col-md-3 image-box">           
                                                                <a href="{{ asset('uploads/surveys/'.$image->file_name) }}" download>
                                                                    {{-- <i class="fa fa-download" aria-hidden="true"></i> --}}
                                                                    <img src="{{ asset('uploads/surveys/'.$image->file_name) }}" alt="{{ $survey->title }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >
                                                                </a>                                    
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="clearfix mb-30 comments-tr"><span>Files <small>(Downloadable on click)</small></span></div>
                                                    <div class="row">
                                                        @foreach($survey->medias()->where('type', null)->get() as $file)
                                                            <div class="col-md-3 media-box">
                                                                <a href="{{ asset('uploads/surveys/'.$file->file_name) }}" download
                                                                   style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                    <h6>{{!is_null($file->title)?$file->title:''}}</h6>
                                                                    <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if(\Carbon\Carbon::parse($survey->due_date)->isPast())
                                                        <div class="alert alert-danger">
                                                            Date to submit the survey is closed 
                                                        </div>
                                                    @else
                                                        <button type="submit" class="btn btn-warning float-right">Submit</button>
                                                    @endif
                                                </form>
                                                
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $( "#modal-no-of-choices" ).change(function() {
                resetChoices(this.value);
            });
            $( "#add-form" ).submit(function(e) {
                e.preventDefault();

                var questionNo = $("#questions > div").length + 1;
                var question = $( "#modal-question" ).val();
                var options = [];
                var optionsHtml = "";
                $("input[name='modal-option[]']").each(function(index ) {
                    console.log($(this).val())
                    options.push($(this).val());
                    optionsHtml += (index+1)+')<input name="q-'+questionNo+'-options[]" class="form-control" type="text" value="'+$(this).val()+'" required readonly/><br>'
                });
                
                var html = '<br><div class"container" id="q-'+questionNo+'">Q<span>'+questionNo+')</span><button type="button" onclick="deleteRow(this)" class="float-right"><i class="fa fa-trash"></i></button><textarea name="questions[]" class="form-control" required readonly>'+question+'</textarea><br>'+optionsHtml+'</div>';
                
                $('#questions').append(html);
                $('#add-question').modal('hide');
                resetModalFields();                
            });
        });

        function resetModalFields()
        {
            $('#modal-question').val('');
            $('#modal-no-of-choices').val(2);
            resetChoices($('#modal-no-of-choices').val());
        }

        function resetChoices(value)
        {
            $( "#options" ).html('');
            for(let i=1;i<=value;i++)
            {
                $( "#options" ).append( $( '<span>'+i+')</span><input type="text" name="modal-option[]" class="form-control">' ) );
            }
        }
        function deleteRow(block)
        {
            jQuery(block).parent().remove();
            
            // TODO: For futrue Use
            $("#questions > div").each(function(i) {
                jQuery(this).attr("id","q-"+(i+1));
                jQuery(this).children('input').each(function(){
                    jQuery(this).attr("name","q-"+(i+1)+"-options[]");
                });
                jQuery(this).children('span').html(i+1);
            });
        }
    </script>
@endsection