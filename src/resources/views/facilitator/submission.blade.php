@extends('facilitator.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Submitted Assessments</h6>
    @if (count($submissions)>0)

    @foreach ($submissions as $submission) 

    <a  href="{{ route('submitted.show', ['id'=> $submission->id])}}">
        <div class="media text-muted pt-3">
          <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
            <strong class="text-gray-dark">{{ $submission->first_name .' '. $submission->last_name }}</strong>
            
              @if ($submission->access == 1)
              <a >Accessed</a>
              @endif
            
            
          
          
          </div>
          <span class="d-block">{{$submission->title}}</span>
          </div>
        </div>
      </a>

      @endforeach
      <small class="d-block text-right mt-3">
         {{$submissions->links()}}
        </small>
    @else
        <p> No assessment submission yet!</p>
    @endif
        
</div>
@endsection