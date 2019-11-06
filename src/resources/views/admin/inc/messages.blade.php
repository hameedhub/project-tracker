@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
    @foreach($errors->() as $error)
            {{$error}}
    @endforeach
        </ul>
        </div>
@endif

<div class="alert alert-success"> Hello </div>
@if(session('success'))
        <div class="alert alert-success"> {{session('success')}} </div>
@endif

@if(session('error'))
        <div class="alert alert-danger"> {{session('error')}} </div>
@endif