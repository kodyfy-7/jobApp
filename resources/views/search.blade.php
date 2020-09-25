@extends('layouts.app')


@section('content')
    <section class="py-5">
        <div class="container py-5">
            <div class="row">
                <!-- Filter-->
                <div class="col-lg-3 order-2 order-lg-1">
                    <h2 class="h3 mb-4 pb-1">&NonBreakingSpace;</h2>
                        <div class="card border-0 shadow-sm mb-4 p-2">
                            <div class="card-body">
                                <h2 class="h5 mb-4">Choose category</h2>
                                <ul>
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
                <!-- Listing-->
                <div class="col-lg-9 mb-5 mb-lg-0 order-1 order-lg-2">
                    <!-- Listing sorting-->
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-7">
                        
                        </div>
                        <div class="col-md-5 text-md-right">
                            <p class="h6 mb-0 p-3 p-md-0">You searched for: <em>{{$search}}</em> </p>
                        </div>
                    </div>
                    <!-- Listing items-->
                    @if(count($details) > 0)
                        <div class="row mb-4">
                            @foreach($details as $detail)
                                <div class="col-lg-6 mb-4">
                                
                                    <div class="card shadow-sm border-0 reset-anchor d-block hover-transition"><a class="d-block dark-overlay card-img-top overflow-hidden tool-trending" href="detail.html">
                                        <div class="card-body p-4">
                                            <h3 class="h5"> <a class="stretched-link reset-anchor" href="/job/{{$detail->job_slug}}">{{$detail->job_title}}</a></h3>
                                            <p class="text-muted text-small mb-0">{{$detail->created_at->diffForHumans()}} by {{$detail->client->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{$details->links('vendor.pagination.custom')}}
                    @else
                        <p>No jobs found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
    


