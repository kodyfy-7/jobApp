@extends('layouts.panelapp')

@section('title')
    Profile | {{ config('app.name', 'Laravel') }} 
@endsection

@section('page_title')
    Profile
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Company Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['action' => ['Users\Client\ProfileController@update', auth()->user()->id], 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
    
                            <div class="form-group">
                                {{Form::label('name', 'Company Name')}}
                                {{Form::text('name', auth()->user()->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '', 'disabled'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('address', 'Address')}}
                                {{Form::text('address', auth()->user()->address, ['id' => 'address', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('city', 'City')}}
                                {{Form::text('city', auth()->user()->city, ['id' => 'city', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('state', 'State')}}
                                {{Form::text('state', auth()->user()->state, ['id' => 'state', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('linkedin', 'Linkedin URL')}}
                                {{Form::url('linkedin', auth()->user()->linkedin_link, ['id' => 'linkedin', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('facebook', 'Facebook URL')}}
                                {{Form::url('facebook', auth()->user()->facebook_link, ['id' => 'facebook', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('twitter', 'Twitter URL')}}
                                {{Form::url('twitter', auth()->user()->twitter_link, ['id' => 'twitter', 'class' => 'form-control', 'placeholder' => ''])}}
                            </div>

                            <div class="form-group col-lg-6 mb-lg-0">
                                {{Form::label('logo', 'Company logo')}}
                                {{Form::file('logo')}}

                                <div class="profile_img">

                                    <!-- Current avatar -->
                                    <div class="avatar-view" title="Change the avatar">
                                        <img src="/storage/company_logos/{{auth()->user()->logo}}" alt="Avatar">
                                    </div>
              
              
                                </div>
                            </div> 
                            {{Form::hidden('_method', 'PUT')}}
                            <div class="col-md-12">
                                {{Form::submit('Update Profile', ['id' => 'action_button', 'class' => 'btn btn-success btn-block'])}}
                            </div>  
                        {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
  
@endsection

@section('script')

@endsection