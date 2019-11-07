@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">{{ __('Edit Course') }}</div>

                <div class="card-body">

                   
                    <form method="POST" action="{{ $action }}">
                            @csrf
                            {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="grade_name" class="col-md-4 col-form-label text-md-right">{{ __('Course Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $course[0]->title }}" required>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                            <textarea id="description" cols="3" class="form-control @error('description') is-invalid @enderror" name="description" required >{{ $course[0]->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="objectives" class="col-md-4 col-form-label text-md-right">{{ __('Objectives') }}</label>

                            <div class="col-md-6">
                            <textarea id="objectives" cols="5" class="form-control @error('objectives') is-invalid @enderror" name="objectives" required >{{ $course[0]->objectives }}</textarea>

                                @error('objectives')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grade_name" class="col-md-4 col-form-label text-md-right">{{ __('Facilitator') }}</label>

                            <div class="col-md-6">
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
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                        
                 </form>


                </div>
                @if(session('success'))
                        <div class="alert alert-success"> {{session('success')}} </div>
                         @endif
                         @if(session('error'))
                         <div class="alert alert-danger"> {{session('error')}} </div>
                 @endif
            </div>
        </div>
    
  
    
    </div>
  </div>
</div>



@endsection