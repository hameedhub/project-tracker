@extends('layouts.app')
@section('content')

<div class="container">
<section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Courses</h1>
          <p class="lead text-muted">The following are the list of availabe courses on {{config('app.name')}}.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Create a new course</a>
            {{-- <a href="#" class="btn btn-secondary my-2">Secondary action</a> --}}
          </p>
        </div>
      </section>
</div>
    
      <div class="album py-5 bg-light">
        <div class="container">
    
          <div class="row">

           @if(count($courses)> 0)
                @foreach ($courses as $course)
                    
                
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-body">
                <h5 class="card-title">{{ $course->title}}</h5>
                <p class="card-text">{{ $course->description }}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="courses/{{$course->id}}" class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="courses/{{$course->id}}/edit" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </div>
                    <small class="text-muted">Facilitator: {{ $course->first_name.' '. $course->last_name}} </small>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

            @else

            @endif


          </div>
        </div>
      </div>
    
   
    @endsection