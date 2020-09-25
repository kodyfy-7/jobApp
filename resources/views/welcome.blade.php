@extends('layouts.app')


@section('content')
    <!-- Hero section-->
    <section class="hero-home py-5">
      <div class="container pt-5">
        <div class="row">
          <div class="col-lg-7 mx-auto text-center">
            <p class="h6 text-uppercase text-primary mb-3">Listings</p>
            <h1 class="mb-5">A curated directory of tools and resources to build your startup.</h1>
            <form action="/search" class="p-2 rounded shadow-sm bg-white">
                @csrf
                <div class="input-group">
                  <input class="form-control border-0 mr-2" name="search" type="search" placeholder="Search jobs ...">
                  <div class="input-group-append rounded">
                    <button class="btn btn-primary rounded" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Resources section-->
    <section class="pb-5">
      <div class="container pb-5">
        <header class="text-center mb-5">
          <h2 class="mb-1">Our Resources Collection</h2>
          <p class="text-muted text-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
        </header>
        <div class="row">
          

          @if(count($jobs) > 0)
            @foreach($jobs as $job)
              <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow border-0 reset-anchor d-block hover-transition">
                  <div class="card-body p-4">
                    <h3 class="h5"> <a class="stretched-link reset-anchor" href="/job/{{$job->job_slug}}">{{$job->job_title}}</a></h3>
                    <div class="media align-items-center">
                      <div class="media-body d-flex ml-2 align-items-center"><span class="small text-muted mr-1">By</span>
                        <h6 class="mb-0"> <a class="reset-anchor" href="#">{{$job->client->name}}</a></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="col-lg-12 text-center pt-5">{{$jobs->links('vendor.pagination.custom')}}</div>
            
            @else
              <p>No jobs found</p>
          @endif
          
        </div>
      </div>
    </section>

    <!-- Categories section-->
    <section class="pb-5">
      <div class="container pb-5">
        <header class="text-center mb-5">
          <h2 class="mb-1">Explore our categories</h2>
          <p class="text-muted text-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
        </header>
        <div class="row text-center">
          @if (count($categories) > 0)
            @foreach ($categories as $category)
              <div class="col-lg-3 px-lg-2">
                <div class="categories-item card border-0 shadow mb-4 reset-anchor hover-transition">
                  <div class="card-body px-4 py-5">
                        <svg class="svg-icon mb-3">
                          <use xlink:href="#stack-1"> </use>
                        </svg>
                    <h2 class="h5"> <a class="stretched-link reset-anchor-inherit" href="#"> {{$category->category_name}} </a></h2>
                    <p class="categories-item-number small mb-0"> {{count($category->jobs)}}</p>
                  </div>
                </div>
              </div>
            @endforeach
            {{$categories->links('vendor.pagination.custom')}}
          @else
              Null
          @endif
        </div>
      </div>
    </section>

    <!-- Newsletter section-->
    <section class="pb-5">
      <div class="container pb-5">
        <header class="text-center mb-5">
          <h2>Free tools to grow your startup</h2>
        </header>
        <div class="row">
          <div class="col-lg-7 mx-auto">
            <form class="p-2 rounded shadow-sm bg-white" action="#">
              <div class="input-group">
                <input class="form-control border-0 mr-2" type="email" placeholder="Enter your email address">
                <div class="input-group-append rounded">
                  <button class="btn btn-primary rounded" type="submit">Get started today</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
    


