@extends('facilitator.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
        {{-- <h6 class="border-bottom border-gray pb-2 mb-0">Available Courses</h6> --}}
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

 <div class="accordion" id="accordionExample">
   <div class="card">
     <div class="card-header" id="headingOne">
       <h2 class="mb-0">
         <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Question
         </button>
       </h2>
     </div>
 
     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
       <div class="card-body">
        {{ $submission[0]->question}}
       </div>
     </div>
   </div>
   <div class="card">
     <div class="card-header" id="headingTwo">
       <h2 class="mb-0">
         <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           Solution
         </button>
       </h2>
     </div>
     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
       <div class="card-body">
         {{ $submission[0]->solution }}
         <?php if($submission[0]->upload !== null){?>
          <br><a class="btn btn-success" href="{{ url('/download/assessment', $submission[0]->upload)}}" target="_blank" >Download File</a>
        <?php } ?>
       </div>
     </div>
   </div>
   <div class="card">
     <div class="card-header" id="headingThree">
       <h2 class="mb-0">
         <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           Note
         </button>
       </h2>
     </div>
     <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
       <div class="card-body">
         {{ $submission[0]->note }}
       </div>
     </div>
   </div>
   <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Grade
            </button>
          </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                        
                        <form method="POST" action="
                        @if(count($report)>0)
                            {{ route('submitted.update', ['id' => $report[0]->id])}}
                            @else
                            {{ route('submitted.store') }}
                        @endif
                        ">
                          @csrf
                          <div>
                            <p></p>
                          </div>
                          <div class="form-group row">
                            <br>
                              <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Grade Type') }}</label>
                    
                              <div class="col-md-8">
                                  <select id="grade_id" class="form-control @error('grade_id') is-invalid @enderror" name="grade_id" required />
                                      <option value="">- Please select Grade Type-</option>
                                      @if(count($report)>0)
                              <option selected value="{{$grade->id}}">{{ $grade->grade_name}}</option>
                                      @endif
                                      @foreach ($grades as $grade)
                                          <option value="{{$grade->id}}">{{ $grade->grade_name }}</option>
                                      @endforeach
                                  </select>
                    
                                  @error('course_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                    
                          <div class="form-group row">
                              <label for="score" class="col-md-2 col-form-label text-md-right">{{ __('Score') }}</label>
                    
                              <div class="col-md-8">
                                  <input id="score" type="number" class="form-control @error('score') is-invalid @enderror" name="score" value="@if(count($report)>0){{$report[0]->score}}@endif" required>
                    
                                  @error('score')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                    
                          <div class="form-group row">
                              <label for="remark" class="col-md-2 col-form-label text-md-right">{{ __('Remark') }}</label>
                    
                              <div class="col-md-8">
                                  <textarea id="remark" rows="5" class="form-control @error('remark') is-invalid @enderror" name="remark" required >@if(count($report)>0){{$report[0]->remark}}@endif</textarea>
                    
                                  @error('remark')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          
                        <input type="hidden" name="assessment_id" value="{{ $submission[0]->assessment_id }}">
                        <input type="hidden" name="student_id" value="{{ $submission[0]->student_id }}" />
                        <input type="hidden" name="id" value="{{$submission[0]->id}}" />
                    
                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-2">
                                    @if (count($report)>0)
                                    {{ method_field('PUT')}}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Grade') }}
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Grade') }}
                                    </button>
                                    @endif
                              </div>
                          </div>
                          
                    </form>
                    
                    </div>


          </div>
        </div>
      </div>
 </div>

 </div>    
@endsection