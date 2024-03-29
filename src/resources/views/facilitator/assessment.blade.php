@extends('facilitator.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h6 class="border-bottom border-gray pb-2 mb-0"><a href="{{ route('evaluation.create')}}">Create Accessment</a></h6>
        
        @if(count($assessments)>0)
        @foreach ($assessments as $assessment)
            
        
<a href="evaluation/{{$assessment->id}}/edit"><div class="media text-muted pt-3">
          <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em"></text></svg>
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <strong class="d-block text-gray-dark"> {{$assessment->title}}</strong>
            created on {{ $assessment->created_at}}
          </p>
        </div>
        </a>
        @endforeach
    
        <small class="d-block text-right mt-3">
          {{$assessments->links()}}
        </small>
        @else
        <p> You haven't given an assessment yet! </p>
        @endif
      </div>    
    
@endsection