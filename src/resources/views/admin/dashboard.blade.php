@extends('admin.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">

    {{-- <h6 class=" border-gray pb-2 mb-0">Courses</h6> --}}
        <div class="border-bottom  ">
        Class
        </div>
    
    @if(count($sets)>0)
    @foreach ($sets as $set)
        
      <a  href="{{ route('set.edit', ['id'=> $set->id])}}">
      <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">{{ $set->title }}</strong>
            <a href="{{ route('set.edit', ['id'=> $set->id])}}">Edit</a>
          </div>
        <span class="d-block">Created: {{ $set->created_at}}</span>
        </div>
      </div>
    </a>
    @endforeach
  
    
    @else
    <p> No set created! </p>
    @endif
  </div>  
@endsection