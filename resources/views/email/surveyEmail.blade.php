<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
	<div class="dashboard">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
	                <div class="content-area5">
	                    <div class="dashboard-content">
	                        <div class="row">
	                            <div class="col-lg-12">
	                                <div class="dashboard-list">
	                                    <div class="dashboard-message bdr clearfix ">

	                                    	<br>
	                                        <label>Venture:</label> {{$venture->venture_name}}
	                                        <br>
	                                        <label>Subject:</label> {{$emailSurvey['survey']['subject']}}
	                                        <br>
	                                        <label>Body:</label> {{$emailSurvey['survey']['body']}}

	                                        <br><br>
	                                        <label>Questions:</label>
	                                        <br><br>
	                                        @foreach($emailSurvey['questions'] as $index=> $data)
	                                        	Q{{$index+1}}) 
	                                        	{{$data['question']['question']}}
	                                        	<br><br>
	                                        	@foreach($data['options'] as $key => $option)
	                                        		{{$key+1}}) {{$option['value']}}
	                                        		<br>
	                                        	@endforeach
	                                        	<br><br>
	                                        @endforeach


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
</body>
</html>