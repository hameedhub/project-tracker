@extends('admin.layouts.app')
@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">

  {{-- <h6 class=" border-gray pb-2 mb-0">Courses</h6> --}}
      <div class="border-bottom  ">
      <a >Manage Users</a>
      </div>
  
  @if(count($users)>0)
  @foreach ($users as $user)
      
    <a  href="{{ route('users.edit', ['id'=> $user->id])}}">
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
        <strong class="text-gray-dark">{{ $user->first_name .' '. $user->last_name }}</strong>
          <a href="{{ route('users.edit', ['id'=> $user->id])}}">Edit</a>
        </div>
      <span class="d-block"><?php
      if ($user->role_id == 1) {
         echo 'Admin';
      }else if($user->role_id == 2){
          echo "Facilitator";
      }else if($user->role_id == 3){
          echo "Student";
      }else{
          echo "None";
      }
      ?></span>
      </div>
    </div>
  </a>
  @endforeach
  
  <small class="d-block text-right mt-3">
    {{$users->links()}}
  </small>
  @else
  <p> No available users </p>
  @endif
</div>  

   
    @endsection