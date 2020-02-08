@extends('student.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
       
        @if(count($courses)>0)
        
        
        <div class="row">
                @foreach ($courses as $course)
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{ $course->title}}</h5>
                    <p class="card-text">
                      <?php echo html_entity_decode($course->description) ?>
                    </p>
                    </p>
                    <a href="{{route('registration.show', ['id'=> $course->id])}}" class="btn btn-sm btn-success">Apply</a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div> 
        
        
       @endif
        
        


</div>

@endsection