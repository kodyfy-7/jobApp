@extends('layouts.app')


@section('content')
    <!-- Hero section-->
    <section class="hero d-flex align-items-end py-5 bg-cover bg-center" style="background: url({{asset('frontend/img/tool-detail-bg.jpg')}})">
        <div class="container index-forward py-5 py-lg-0">
          <div class="row align-items-end">
            <div class="col-lg-7 mb-4 mb-lg-0">
              <div class="media align-items-center"><img class="rounded-circle" src="/storage/company_logos/{{$company->logo}}" alt="" width="80">
                <div class="media-body ml-3">
                  <h1 class="text-white">{{$job->client->name}}</h1>
                  <ul class="list-inline mb-0 text-small">
                    <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 text-lg-right">
              <ul class="list-inline mb-0">
                @if(!Auth::guest())
                  <li class="list-inline-item m-1">
                    <a class="btn btn-outline-light px-3" href="#" rel="tooltip" data-toggle="modal" data-placement="top" title="Apply" data-target="#shareModal"><i class="fas fa-reply"></i></a>
                  </li>
                @else 
                  <p>You have to login before applying.</p>
                @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            @guest
            <div class="modal-content">
              <div class="modal-header px-lg-5">
                <h5 class="modal-title" id="shareModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body px-lg-5">
                Oops! You must be logged in before applying.
              </div>
              <div class="modal-footer justify-content-start px-lg-5">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              </div>
            </div>    
            @else
              @if (auth()->user()->profile_status > 0)
                {!! Form::open(['action' => 'Users\User\ApplicationController@apply', 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
                  <div class="modal-content">
                    <div class="modal-header px-lg-5">
                      <h5 class="modal-title" id="shareModalLabel">Add Listing</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body px-lg-5">
                      <div class="row">
                        @if (auth()->user()->resume_id == null)
                          <div class="form-group col-lg-6 mb-lg-0">
                            {{Form::label('cv_file', 'CV')}}
                            {{Form::file('cv_file')}}
                          </div> 
                          {{Form::hidden('job_title', $job->job_title)}}
                          {{Form::hidden('job_id', $job->id)}}
                          {{Form::hidden('resume_id', auth()->user()->resume_id)}}
                          {{Form::hidden('cemail', $company->email)}}
                        @else
                          <p>You are about to apply for this job using your default CV titled.</p>
                          <p> You can upload a new CV if you wish.</p>
                          <div class="form-group col-lg-6 mb-lg-0">
                            {{Form::label('cv_file', 'CV')}}
                            {{Form::file('cv_file')}}
                          </div> 
                          <div class="form-group col-lg-6 mb-lg-0">
                            {{Form::label('status', 'Status')}}
                            {{Form::select('status',  ['1' => 'Default', '0' => 'Not Default'], null,['id' => 'status', 'class' => 'form-control', 'placeholder' => 'Select CV Status'])}}
                          </div>
                          {{Form::hidden('job_title', $job->job_title)}}
                          {{Form::hidden('job_id', $job->id)}}
                          {{Form::hidden('resume_id', auth()->user()->resume_id)}}
                          {{Form::hidden('cemail', $company->email)}}   
                        @endif
                        
                      </div>
                    </div>
                    <div class="modal-footer justify-content-start px-lg-5">
                      {{Form::submit('Apply', ['class' => 'btn btn-primary'])}}
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              @else 
              <div class="modal-content">
                <div class="modal-header px-lg-5">
                  <h5 class="modal-title" id="shareModalLabel">Application</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body px-lg-5">
                  <p>You have an incomplete profile, please do well to fill it before applying.</p>
                </div>
                <div class="modal-footer justify-content-start px-lg-5">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
              </div>
              @endif

            @endguest
          </div>
        </div>
        <!-- /modals -->
    </section>
    <section class="py-5">
      <div class="container py-5">
        <div class="row">
          <div class="col-lg-8 mb-5 mb-lg-0">
            @if (count($errors) > 0)
              <div class="alert alert-success alert-block">
                <button class="close" type="button" data-dismiss="alert">x</button>
                <ul>
                  @foreach ($errors->all as $error)
                      <li> {{$error}} </li>
                  @endforeach
                </ul>
              </div>
            @endif
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button class="close" type="button" data-dismiss="alert">x</button>
                  <strong> {{$message}} </strong>
                </div>
            @endif
            <!-- About-->
            <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0">
              <div class="card-body p-lg-5">
                <h2 class="h3 mb-4">{{$job->job_title}}</h2>
                <p>{{$job->job_description}}</p>
                <p class="mb-0">Deadline: {{$job->job_deadline}}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <!-- Social widget-->
            <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0">
              <div class="card-body p-lg-5">
                <h2 class="h3 mb-4">Social links</h2>
                <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a class="social-link facebook" href="{{$company->facebook_link}}"><i class="fab fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a class="social-link twitter" href="{{$company->twitter_link}}"><i class="fab fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a class="social-link vimeo" href="{{$company->linkedin_link}}"><i class="fab fa-vimeo"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- Categories widget-->
            <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0">
              <div class="card-body p-lg-5">
                <h2 class="h3 mb-4">Categories</h2>
                <ul class="list-inline mb-0">
                  @if(count($categories) > 0)
                    @foreach($categories as $category)
                      <li class="list-inline-item m-1"><a class="btn btn-light" href="/category/{{$category->category_slug}}">{{$category->category_name}}</a></li>
                    @endforeach
                        
                  @else
                    <li class="list-inline-item m-1"><a class="btn btn-light" href="#">No categories found</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>     

    

@endsection
    


