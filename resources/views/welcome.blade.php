@extends('layouts.app')


@section('content')
    <!-- Hero section-->
    <section class="hero-home py-5">
      <div class="container pt-5">
        <div class="row">
          <div class="col-lg-7 mx-auto text-center">
            <p class="h6 text-uppercase text-primary mb-3">{{ config('app.name', 'JobApp') }}</p>
            <h1 class="mb-5">A curated directory of jobs across Nigeria.</h1>
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
    @if(count($jobs) > 0)
      <section class="pb-5">
        <div class="container pb-5">
          <header class="text-center mb-5">
            <h2 class="mb-1">Vacancy</h2>
            <p class="text-muted text-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
          </header>
          <div class="row">
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
          </div>
        </div>
      </section>
    @else
      <section class="py-5">
        <div class="container py-5">
          <div class="row text-center">
            <div class="col-lg-10 mx-auto">
              <div class="card border-0 shadow">
                <div class="card-body p-5">
                  <div class="row">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                          <svg class="svg-icon mb-3 text-primary svg-icon-big">
                            <use xlink:href="#list-details-1"> </use>
                          </svg>
                      <h2 class="h5 label-danger">No jobs found</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

    <!-- Categories section-->
    @if (count($categories) > 0)
      <section class="pb-5">
        <div class="container pb-5">
          <header class="text-center mb-5">
            <h2 class="mb-1">Explore categories</h2>
            <p class="text-muted text-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
          </header>
          <div class="row text-center">
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
          </div>
        </div>
      </section>
    @else
      <section class="py-5">
        <div class="container py-5">
          <div class="row text-center">
            <div class="col-lg-10 mx-auto">
              <div class="card border-0 shadow">
                <div class="card-body p-5">
                  <div class="row">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                          <svg class="svg-icon mb-3 text-primary svg-icon-big">
                            <use xlink:href="#list-details-1"> </use>
                          </svg>
                      <h2 class="h5">No categories found</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

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
    


