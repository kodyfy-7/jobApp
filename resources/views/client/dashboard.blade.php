@extends('layouts.panelapp')

@section('title')
    Dashboard | {{ config('app.name', 'Laravel') }} 
@endsection

@section('page_title')
    Dashboard
@endsection

@section('content')
  @if (auth()->user()->profile_status > 0)
      <!-- top tiles -->
      <div class="row top_tiles">
        <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-suitcase"></i>
            </div>
            <div class="count">{{$countJobs}}</div>

            <h3>Jobs posted</h3>
            <p>&NonBreakingSpace;</p>
          </div>
        </div>
      </div>
      <!-- /top tiles -->
  @else
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger fade in" role="alert">
          <strong>You need a complete profile before posting jobs. Please, <a href="/client/profile">click here!!!</a></strong>
        </div>
      </div>
    </div>
  @endif
  
@endsection

@section('script')
    
@endsection