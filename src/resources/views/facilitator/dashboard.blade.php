@extends('facilitator.layouts.app')
@section('content')
    

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Facilitated Courses</h6>
    
    @if(count($courses)>0)
    @foreach ($courses as $course)
        
    
    <a href="{{ route('course.show', ['id'=> $course->id])}}"><div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <strong class="d-block text-gray-dark"> {{$course->title}}</strong>
        <?php echo strip_tags($course->description) ?>
      </p>
    </div>
    </a>
    @endforeach

    <small class="d-block text-right mt-3">
    <a href="{{ route('course.index')}}">View All</a>
    </small>
    @else
    <p> No Course Facilitated </p>
    @endif
  </div>    

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Submitted Assessment</h6>
  @if (count($submissions)>0)

      @foreach ($submissions as $submission)
      
  <a  href="{{route('submitted.update', ['id' =>$submission->id])}}">
        <div class="media text-muted pt-3">
          <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
            <strong class="text-gray-dark">{{ $submission->first_name .' '.$submission->last_name}}</strong>
            @if ($submission->access == 1)
            <a >Accessed</a>    
            @endif  
            
            </div>
          <span class="d-block">{{ $submission->title}}</span>
          </div>
        </div>
      </a>
      @endforeach
      <small class="d-block text-right mt-3">
          <a href="{{ route('submitted.index')}}">View all Assessment</a>
          </small>
  @else
    <p> No submitted assessment</p>
  @endif
</div>

  @endsection