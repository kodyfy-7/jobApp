@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="mb-4">
        <li class="btn btn-danger">{{session('error')}}</li>
    </div>
	@endforeach
@endif

@if(session('success'))
    <div class="mb-4">
        <li class="btn btn-danger">{{session('success')}}</li>
    </div>
@endif	

@if(session('error'))
    <div class="mb-4">
        <li class="btn btn-danger">{{session('error')}}</li>
    </div>
@endif	