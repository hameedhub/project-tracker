@extends('facilitator.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Add Material</h6>
    <form method="POST" action="{{ route('material.store') }}" enctype="multipart/form-data" >
      @csrf
      <div>
        <p></p>
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
      <div class="form-group row">
        <br>
          <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Course') }}</label>

          <div class="col-md-8">
              <select id="course_id" class="form-control @error('course_id') is-invalid @enderror" name="course_id" required>
                  <option value="">- Please select Course -</option>
                  @foreach ($courses as $course)
                      <option value="{{$course->id}}">{{ $course->title }}</option>
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
          <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

          <div class="col-md-8">
              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

              @error('title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

          <div class="col-md-8">
              <textarea id="description" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" required ></textarea>

              @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="form-group row">
            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('File') }}</label>
                <div class="col-md-8">
                       
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <input type="file" class="custom-file-input"class="form-control @error('file') is-invalid @enderror" name="file" required>
                    
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
      

      <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-2">
              <button type="submit" class="btn btn-primary">
                  {{ __('Save Material') }}
              </button>
          </div>
      </div>
      
</form>

</div>
@endsection