@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                            @if (Auth::user()->status > 0)
                                Activated
                            @else
                                Not activated
                            @endif
                            ${{ Auth::user()->name}}
                            
                        </div>
                    @endif
                    @if (Auth::user()->status > 0)
                        Activated
                    @else
                        Not activated
                    @endif
                    <br>
                    ${{ Auth::user()->balance}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
