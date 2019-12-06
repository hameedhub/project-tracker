@extends('admin.layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success"> {{session('success')}} </div>
 @endif
 @if(session('error'))
 <div class="alert alert-danger"> {{session('error')}} </div>
@endif

<div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Create Set</h6>
        <br>
                <form method="POST" action="{{ route('set.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Set Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                        
                 </form>


                </div>
               
            </div>
        </div>



@endsection