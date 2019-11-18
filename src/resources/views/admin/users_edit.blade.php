@extends('admin.layouts.app')

@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">

            <form>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="first_name">First Name</label>
                      <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="First Name" disabled>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" value="" id="last_name" value="{{ $user->last_name}}" placeholder="Last Name" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputPhone">Phone</label>
                            <input type="tel" value="{{$user->phone}}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputState">Email Address</label>
                              <input type="tel" value="{{$user->email}}" class="form-control" disabled>
                            </div>
                            
                          </div>
                    <div class="form-group">
                      <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" value="{{ $user->address}}" id="inputAddress" placeholder="Address" disabled>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputPhone">Registered Date | Time</label>
                      <input type="tel" value="{{$user->created_at}}" class="form-control" disabled>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputState">Role</label>
                        <select id="inputState" name="role_id" class="form-control" required>
                          <option value="">- Please select a Role -</option>
                        <option selected value="{{$user->role_id}}">
                            <?php
                                if($user->role_id == 1){
                                    echo "Admin";
                                } elseif ($user->role_id == 2) {
                                    echo "Facilitator";
                                } elseif ($user->role_id == 3) {
                                    echo "Student";
                                }else {
                                    echo "None";
                                }
                                
                                ?>
                        </option> 
                          <option value="0">None</option>
                          <option value="1">Admin</option>
                          <option value="2">Facilitator</option>
                          <option value="3">Student</option>
                        </select>
                      </div>
                      
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>

    </div>

    {{-- Based on Role Facilitator --}}
@if ($user->role_id == 2)
<div class="my-3 p-3 bg-white rounded shadow-sm">
        <a >Facilitated Courses</a>
        <hr>


@if(count($courses)>0)
@foreach ($courses as $course)
  
<div class="media text-muted pt-3">
  <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
  <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
    <div class="d-flex justify-content-between align-items-center w-100">
    <strong class="text-gray-dark">{{ $course->title }}</strong>
     
    </div>
  <span class="d-block">{{ $course->description}}</span>
  </div>
</div>
@endforeach
@else
<p> No course facilitated! </p>
@endif
</div>
<div class="my-3 p-3 bg-white rounded shadow-sm">
        <a >Created Assessment</a>
        <hr>


@if(count($assessments)>0)
@foreach ($assessments as $assessment)
  
<div class="media text-muted pt-3">
  <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
  <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
    <div class="d-flex justify-content-between align-items-center w-100">
    <strong class="text-gray-dark">{{ $assessment->title }}</strong>
     
    </div>
  <span class="d-block">{{ $assessment->question}}</span>
  </div>
</div>
@endforeach
@else
<p> No assessment record! </p>
@endif
</div>  
@endif

    {{-- Based on Role Student --}}
    @if ($user->role_id == 3)
    <div class="my-3 p-3 bg-white rounded shadow-sm">
            <a >Registered Courses</a>
            <hr>
    
    
    @if(count($courses)>0)
    @foreach ($courses as $course)
      
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
        <strong class="text-gray-dark">{{ $course->title }}</strong>
         
        </div>
      <span class="d-block">{{ $course->description}}</span>
      </div>
    </div>
    @endforeach
    @else
    <p> No course facilitated! </p>
    @endif
    </div>
    <div class="my-3 p-3 bg-white rounded shadow-sm">
            <a >Report</a>
            <hr>
    
    
    @if(count($assessments)>0)
    @foreach ($assessments as $assessment)
      
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
        <strong class="text-gray-dark">{{ $assessment->title }}</strong>
         
        </div>
      <span class="d-block">
          Remark: {{$assessment->remark}}
      </span>
      <br>
      <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{$assessment->score}}%;" aria-valuenow="{{$assessment->score}}" aria-valuemin="{{$assessment->min}}" aria-valuemax="{{$assessment->max}}">{{$assessment->score}}%</div>
                  </div>

      </div>
    </div>
    @endforeach
    @else
    <p> No assessment record! </p>
    @endif
    </div>  
    @endif

@endsection