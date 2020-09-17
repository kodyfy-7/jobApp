
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
                    @if (count($jobs) > 0)
                        <table id="datatable" class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 20%">Title</th>
                                    <th style="width: 20%">Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td>
                                            <a>{{$job->job_title}}</a>
                                            <br />
                                            <small>{{$job->job_deadline}}</small>
                                        </td>
                                        <td>
                                            @if ($job->job_status == 1)
                                                {!! Form::open(['action' => ['Users\Client\JobsController@unpublish', $job->id], 'id' => 'status_form', 'method' =>'POST']) !!}
                                                    {{Form::hidden('hidden_job_id',  $job->id , ['id' => 'payment_hidden_id', 'class' => 'form-control'])}}   
                                                    {{Form::button('<i class="fa fa-eye"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'title' => 'Unpublish'])}}                        
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['action' => ['Users\Client\JobsController@publish', $job->id], 'id' => 'status_form', 'method' =>'POST']) !!}
                                                    {{Form::hidden('hidden_job_id',  $job->id , ['id' => 'payment_hidden_id', 'class' => 'form-control'])}}   
                                                    {{Form::button('<i class="fa fa-eye-slash"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-xs', 'title' => 'Publish'])}}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/client/jobs/{{$job->job_slug}}/edit" class="btn btn-default btn-xs">Edit</a>
                                            <div style="float: right">{!!Form::open(['action' => ['Users\Client\JobsController@destroy', $job->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
                                            {!!Form::close()!!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No data available</p>
                    @endif       
                </div>
                
            </div>
        </div>
    </div>
  
@endsection

@section('script')
    
@endsection