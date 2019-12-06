@extends('facilitator.layouts.app')

@section('content')
@if(session('success'))
  <p></p>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> {{session('success')}} </strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                   @endif
                   @if(session('error'))
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong> {{session('error')}} </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
           @endif

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0"><a href="{{ route('material.create')}}">Add Material</a></h6>
  @if (count($materials)>0)

      @foreach ($materials as $material)
      
  <a  href="{{route('material.update', ['id' => $material->id])}}">
        <div class="media text-muted pt-3">
          <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
            <strong class="text-gray-dark">{{ $material->title}}</strong>  </a>
            <form action="{{ route('material.destroy', $material->id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit">Delete</button>
            </form>
            
            </div>
          {{-- <span class="d-block">Created: {{ $material->created_at}}</span>
           --}}
          </div>
        </div>
     
      @endforeach
      <small class="d-block text-right mt-3">
          {{$materials->links()}}
          </small>
  @else
    <p> No available material</p>
  @endif
</div>


@endsection