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
	                                        <label>From:</label> {{$user->first_name}} {{$user->last_name}}
	                                        <br>
	                                        <label>Venture:</label> {{$venture->venture_name}}
	                                        <br>
	                                        <label>Subject:</label> {{$request->subject}}
	                                        <br>
	                                        <label>Body:</label> {{$request->body}}
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