
@extends('layouts.panelapp')

@section('title')
    Jobs | BlogApp 
@endsection

@section('page_title')
    Jobs
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Listed Jobs </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{$job->id}}
                    {{$job->job_title}}
                    {{$job->job_description}}
                </div>
                
            </div>
        </div>
    </div>
  
@endsection

@section('script')
    
@endsection