@extends('facilitator.layouts.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Create Assessment</h6>
    <form method="POST" action="{{ '../evaluation' }}">
      @csrf
      <div>
        <p></p>
      </div>
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
          <label for="instruction" class="col-md-2 col-form-label text-md-right">{{ __('Instructions') }}</label>

          <div class="col-md-8">
              <textarea id="article-ckeditor" rows="5" class="form-control @error('instruction') is-invalid @enderror" name="instruction" required ></textarea>

              @error('instruction')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="form-group row">
          <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('Question/Task') }}</label>

          <div class="col-md-8">
              <textarea id="article-ckeditor-1" rows="10" class="form-control @error('question') is-invalid @enderror" name="question" required ></textarea>

              @error('question')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="due_date" class="col-md-2 col-form-label text-md-right">{{ __('Due Date') }}</label>

          <div class="col-md-8">
              <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" required>

              @error('due_date')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      

      <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-2">
              <button type="submit" class="btn btn-primary">
                  {{ __('Send Assessment') }}
              </button>
          </div>
      </div>
      
</form>

</div>
@endsection