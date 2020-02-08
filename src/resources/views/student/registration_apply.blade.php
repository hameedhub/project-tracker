@extends('student.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
       {{-- <h6 class="border-bottom border-gray pb-2 mb-0">Available Courses</h6> --}}
       
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Introduction
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <p> The course title is {{ $course->title}}</p>

        <p>
                
                <form method="POST" action="{{ route('registration.store') }}">
                    @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                <button type="submit" class="btn btn-sm btn-success">Appy</button>
            </form>

        </p>
        @if(session('success'))
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


      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Description
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <?php echo html_entity_decode($course->description) ?>
      </p>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Objectives
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <?php echo html_entity_decode($course->objectives); ?>
      </p>
      </div>
    </div>
  </div>
</div>
</div>
@endsection