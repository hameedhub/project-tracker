@extends('admin.layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success"> {{session('success')}} </div>
 @endif
 @if(session('error'))
 <div class="alert alert-danger"> {{session('error')}} </div>
@endif
<div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Create Course</h6>
        <br>
        <form method="POST" action="{{ $action }}">
                            @csrf
                            {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Course Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $course[0]->title }}" required>

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
                            <textarea id="article-ckeditor" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" required >{{ $course[0]->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="objectives" class="col-md-2 col-form-label text-md-right">{{ __('Objectives') }}</label>

                            <div class="col-md-8">
                            <textarea id="article-ckeditor-1" rows="10" class="form-control @error('objectives') is-invalid @enderror" name="objectives" required >{{ $course[0]->objectives }}</textarea>

                                @error('objectives')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Facilitator') }}</label>

                            <div class="col-md-8">
                                <select id="facilitor_id" class="form-control @error('title') is-invalid @enderror" name="facilitator_id" required>
                                    <option value="0">- Please select Facilitator -</option>
                                <option selected value="{{$course[0]->facilitator_id }}">{{ $course[0]->first_name.' '. $course[0]->last_name }}</option>
                                    @foreach ($facilitators as $facilitator)
                                        <option value="{{$facilitator->id}}">{{ $facilitator->first_name.' '. $facilitator->last_name }}</option>
                                    @endforeach
                                </select>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{method_field('PUT')}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                        
                 </form>


                 <form method="POST" action="{{ route('courses.destroy', ['id' => $course[0]->id] ) }}">
                    @csrf
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                     
                     {{ method_field('DELETE')}}
                         <button type="" class="btn btn-danger">
                             {{ __('Delete') }}
                         </button>
                        </div>
                    </div>
                      
                   </form>


                </div>
               
            </div>
        </div>


@endsection