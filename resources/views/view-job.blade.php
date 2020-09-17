@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $job->job_title }} <br> <small>Posted on {{$job->created_at}} by {{$job->client->name}}</small></div>

                <div class="card-body">
                    {{ $job->job_description }}

                    <br>
                    Deadline: {{ $job->job_deadline }}
                    <br>
                    <hr>
                    <br>
                    @if(!Auth::guest())
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Apply</button>

                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
            
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                                    </div>
                                    {!! Form::open(['action' => 'Users\User\HomeController@upload', 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
                                        <div class="modal-body">
                                            <h4>Text in a modal</h4>
                                        
                                            
                                        

                                        
                                            <div class="form-group">
                                                {{Form::file('cv_file')}}
                                            </div> 
                                            <div class="form-group">
                                                {{Form::label('status', 'Status')}}
                                                {{Form::select('status',  ['1' => 'Default', '0' => 'Not Default'], null,['id' => 'status', 'class' => 'form-control', 'placeholder' => 'Select CV Status'])}}
                                            </div>
                                            {{Form::hidden('job_title', $job->job_title)}}
                                            {{Form::hidden('job_id', $job->id)}}
                                            {{Form::hidden('resume_id', auth()->user()->resume_id)}}
                                            
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                    </div>
                                    {!! Form::close() !!}
            
                                </div>
                            </div>
                        </div>
                        <!-- /modals -->
                    @else 
                        You have to login before applying.
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('jobs') }}</div>

                <div class="card-body">
                    <form action="/search" class="search-form">
                        @csrf
                        <div class="form-group">
                          <input type="search" name="search" id="search" placeholder="What are you looking for?">
                          <button type="submit" class="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>

                    @if(count($categories) > 0)
                        <ul class="list-group mt-3">
                            @foreach($categories as $category)
                            
                                <li class="list-group-item">
                                    <a href="/category/{{$category->category_slug}}">{{$category->category_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No categories found</p>
                    @endif
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
