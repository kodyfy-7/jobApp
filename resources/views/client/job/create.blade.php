
@extends('layouts.panelapp')

@section('title')
    Jobs | BlogApp 
@endsection

@section('page_title')
    Jobs <a href="/client/jobs" class="btn btn-info btn-xs">Go back</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>New Job</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['action' => 'Users\Client\JobsController@store', 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
  
                        <div class="form-group">
                            {{Form::label('title', 'Job Title')}}
                            {{Form::text('title', '', ['id' => 'title', 'class' => 'form-control', 'placeholder' => ''])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('category', 'Select Category')}}
                            {{Form::select('category', App\Category::pluck('category_name', 'id'), '',['id' => 'category', 'class' => 'form-control', 'placeholder' => 'Select Job Category'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('deadline', 'Job Deadline')}}
                            {{Form::text('deadline', '', ['id' => 'single_cal2', 'class' => 'form-control', 'placeholder' => '', 'aria-describedby' => 'inputSuccess2Status2'])}}
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('content', 'Job Description')}}
                            {{Form::textarea('content', '', ['id' => 'content', 'class' => 'form-control content', 'placeholder' => ''])}}                          
                        </div>

                        <div class="col-md-12">
                            {{Form::submit('Submit', ['id' => 'action_button', 'class' => 'btn btn-success btn-block'])}}
                        </div>  
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>
  
@endsection

@section('script')
    <!-- nicescroll js -->
    <script src="{{ asset('backend/js/nicescroll/jquery.nicescroll.min.js') }}"></script>

    <!-- daterangepicker -->
    <script type="text/javascript" src="{{ asset('backend/js/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/datepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#single_cal2').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_2"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        });
    </script>
@endsection
