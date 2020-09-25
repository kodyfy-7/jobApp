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
      <div class="row tile_count">
        <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
          <div class="left"></div>
          <div class="right">
              <span class="count_top"><i class="fa fa-exclamation"></i> Status</span>
              <span class="count_top"><i class="fa fa-exclamation"></i> Status</span>
              <div class="count"><span><i class="fa fa-smile-0"></i> Total Users</span></div>
              <span class="count_bottom"><i class="green">Not activated</i></span>
          </div>
        </div>
        <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
          <div class="left"></div>
          <div class="right">
            <span class="count_top"><i class="fa fa-clock-o"></i> Balance</span>
            <div class="count">$</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
          </div>
        </div>

      </div>
      <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>My Profile </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                </div>
                
            </div>
        </div>
    </div>  
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