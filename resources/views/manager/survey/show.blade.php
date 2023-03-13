@extends('manager.layouts.partials.dashboardApp')
@section('page_title')
    Survey Form | Manager Panel
@endsection
@section('content')
    <style>
        label{
            font-weight: bold;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 5px;
            font-size: 15px;
            padding: 1px;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('manager.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>Survey Form</span>
                                            </div>
                                            <form method="POST" action="{{url('/manager/survey/store')}}">
                                                @csrf()
                                                <label>Venture:</label>
                                                <input type="text" name="venture_id" value="{{$survey->venture->venture_name}}" class="form-control" required readonly/>
                                                <br><br>
                                                <label>Subject</label>
                                                <input type="text" name="subject" value="{{$survey->subject}}" class="form-control" required readonly/>
                                                <br><br>
                                                <label>Body</label>
                                                <textarea name="body" value="{{$survey->body}}"  class="form-control" required="true" readonly>{{$survey->body}}</textarea>
                                                <br><br>
                                                <label class="form-label">Due Date :</label>
                                                <div class="form-group">
                                                    <div class="datepicker mdp date input-group p-0 shadow-sm">
                                                        <input type="text" value="{{$survey->due_date}}"  placeholder="Due Date" class="form-control box-shadow" name="due_date" required readonly/>
                                                        <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <label>Questions</label>
                                                <div id="questions">
                                                    @foreach($questions as $key=> $data)
                                                        Q<span>{{$key+1}})</span><textarea name="questions[]" class="form-control" required readonly>{{$data->question}}</textarea>
                                                        @foreach($data->options as $key2 => $option)
                                                            {{$key2+1}}) <label class="btn-success">{{Helper::optionPercentage($option->id,$survey->id)}}%</label>
                                                            <input name="q-'+questionNo+'-options[]" class="form-control" type="text"  value="{{$option->value}}" required readonly/>
                                                            <br>
                                                        @endforeach
                                                        <hr>
                                                    @endforeach
                                                </div>
                                                <br><br>
                                            </form>
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
    <div class="modal fade" id="add-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Question?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="add-form">
                    @csrf
                    <div class="modal-body">
                        <label>Number Of Choices:</label>
                        <select id="modal-no-of-choices" class="form-control" name="no_of_choices" required>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <br><br>
                        <label>Question:</label>
                        <textarea id="modal-question" class="form-control" name="question" required></textarea>
                        <br><br>
                        <div id="options">
                            <span>1)</span><input type="text" name="modal-option[]" class="form-control" required readonly/>
                            <span>2)</span><input type="text" name="modal-option[]" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="add" class="btn btn-primary cancel-commit">Add</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
@endsection
@section('javaScript')
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