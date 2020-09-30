@extends('layouts.panelapp')

@section('title')
    Dashboard | {{ config('app.name', 'Laravel') }} 
@endsection

@section('page_title')
    Dashboard
@endsection

@section('content')

  <!-- top tiles -->
  <div class="row tile_count">
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
      <div class="left"></div>
      <div class="right">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count"> {{$countUsers}} </div>
        <span class="count_bottom"><i class="green">4% </i> From last Week</span>
      </div>
    </div>
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
      <div class="left"></div>
      <div class="right">
        <span class="count_top"><i class="fa fa-building-o"></i> Total Clients</span>
        <div class="count">{{$countClients}}</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
      </div>
    </div>
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
      <div class="left"></div>
      <div class="right">
        <span class="count_top"><i class="fa fa-briefcase"></i> Jobs</span>
        <div class="count green">{{$countJobs}}</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
    </div>

  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Users</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          @if (!empty($users))
            <table  id="datatable" class="table table-striped projects">
              <thead>
                <th>S/N</th>
                <th>Name</th>
                <th>Action</th>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  <tr>
                    <td> {{$loop->iteration}} </td>
                    <td> {{$user->name}} </td>
                    <td> 
                        <a href="/admin/users/{{$user->email}}" class="btn btn-default btn-xs">view</a>
                        <div style="float: right">{!!Form::open(['action' => ['Users\Admin\AdminController@destroy_user', $user->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
                        {!!Form::close()!!}
                        </div> 
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td> Empty </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          @endif
        </div>
             
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Catgeory</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".category_modal">Add a cateegory</button></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          @if (!empty($categories))
            <table  id="datatable" class="table table-striped projects">
              <thead>
                <th>S/N</th>
                <th>Name</th>
                <th>Action</th>
              </thead>
              <tbody>
                @forelse ($categories as $category)
                  <tr>
                    <td> {{$loop->iteration}} </td>
                    <td> {{$category->category_name}} </td>
                    <td> 
                        {!!Form::open(['action' => ['Users\Admin\CategoryController@destroy', $category->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
                        {!!Form::close()!!}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td> Empty </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          @endif
        </div>
        

        <div class="modal fade category_modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            {!! Form::open(['action' => 'Users\Admin\CategoryController@store', 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel2">New Category</h4>
                </div>
                <div class="modal-body">

                  <div class="form-group">
                    {{Form::label('category', 'Category Name')}}
                    {{Form::text('category', '', ['id' => 'category', 'class' => 'form-control', 'placeholder' => '', ])}}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  {{Form::submit('Submit', ['id' => 'action_button', 'class' => 'btn btn-success'])}}
                </div>

              </div>
            {!! Form::close() !!}
          </div>
        </div>

      </div>
    </div>
  </div>
    
@endsection

@section('script')
    
@endsection