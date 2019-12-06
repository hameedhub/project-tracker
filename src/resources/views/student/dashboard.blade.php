@extends('student.layouts.app')
@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Your courses</h6>
    @if(count($courses) > 0)
      @foreach ($courses as $course)
      <a href="{{route('registration.update', ['id'=> $course->id])}}">
      <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">{{$course->title}}</strong>
          {{ $course->description }}
        </p>
      </div>
      </a>
      @endforeach
    @else 
    <p><i style="color:red">Note:</i> You have not registered for any course or Courses registered as not been approved! </p>
    @endif
    
    <small class="d-block text-right mt-3">
      {{$courses->links()}}
    </small>

</div>

@endsection
