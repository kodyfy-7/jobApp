@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Jobs') }}</div>

                <div class="card-body">
                    @if(count($jobs) > 0)
                        @foreach($jobs as $job)
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h3><a href="/job/{{$job->job_slug}}">{{$job->job_title}}</a></h3>
                                        <small>Posted on {{$job->created_at}} by {{$job->client->name}} | <div class="category"><a href="/category/{{$job->category->category_slug}}">{{$job->category->category_name}}</a></div></small>
                                    </div>
                                </div>                                
                            </div>
                            <hr>
                        @endforeach
                        {{$jobs->links()}}
                    @else
                        <p>No jobs found</p>
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
