@extends('student.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
       {{-- <h6 class="border-bottom border-gray pb-2 mb-0">Available Courses</h6> --}}
       
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Instruction
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        {{$assessment->instruction}}
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Question
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        {{ $assessment->question }}
      </div>
    </div>
  </div>
  <div class="card">
      <div class="card-header" id="headingThree">
        <h2 class="mb-0">
          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Your Solution
          </button>
        </h2>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
          
           
                <form method="POST" action="@if(count($submission)>0)
                  {{route('submission.update', ['id'=> $submission[0]->id])}}
                  @else
                  {{ route('submission.store') }}
                  @endif
                  ">
                  @csrf
                  <div>
                    <p></p>
                  </div>
                 
            
                  <div class="form-group row">
                      <label for="solution" class="col-md-2 col-form-label text-md-right">{{ __('Solution') }}</label>
            
                      <div class="col-md-8">
                      <textarea id="solution" rows="10" class="form-control @error('solution') is-invalid @enderror" name="solution" required > @if(count($submission)>0){{$submission[0]->solution}}@endif</textarea>
            
                          @error('solution')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="note" class="col-md-2 col-form-label text-md-right">{{ __('Notes') }}</label>
            
                      <div class="col-md-8">
                          <textarea id="note" rows="3" class="form-control @error('note') is-invalid @enderror" name="note">@if(count($submission)>0){{$submission[0]->note}}@endif</textarea>
            
                          @error('note')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                 
                      <div class="form-group row">
                          <label for="note" class="col-md-2 col-form-label text-md-right">{{ __('') }}</label>
                        <div class="col-md-8">
                          <div class="custom-file">
                              
                              <input type="file" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Document Upload</label>
                              
                            </div>
                        </div>
                      </div>
                   
                  
                  
                      <input type="hidden" name="student_id" value="1" />
                    <input type="hidden" name="course_id" value="{{ $assessment->course_id}}" />
                    <input type="hidden" name="assessment_id" value="{{ $assessment->id }}" />

                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-2">
                          
                        @if (count($submission)>0)
                        {{ method_field('PUT')}}
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Assessment') }}
                        </button>
                        @else
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit Assessment') }}
                        </button>
                        @endif
                        
                      </div>
                  </div>
                  
            </form>


        </div>
      </div>
    </div>
</div>

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



</div>
@endsection