@extends('admin.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-header">{{ __('Add Grade') }}</div>
    
                    <div class="card-body">


                        <form method="POST" action="{{ 'grades' }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="grade_name" class="col-md-4 col-form-label text-md-right">{{ __('Grade Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="grade_name" type="text" class="form-control @error('grade_name') is-invalid @enderror" name="grade_name" value="{{ old('grade_name') }}" required autocomplete="grade_name" autofocus>
    
                                    @error('grade_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="max" class="col-md-4 col-form-label text-md-right">{{ __('Max Score') }}</label>
    
                                <div class="col-md-6">
                                    <input id="max" type="number" class="form-control @error('max') is-invalid @enderror" name="max" required autocomplete="Max score">
    
                                    @error('max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="max" class="col-md-4 col-form-label text-md-right">{{ __('Min Score') }}</label>
    
                                <div class="col-md-6">
                                    <input id="min" type="number" class="form-control @error('min') is-invalid @enderror" name="min" required autocomplete="Min score">
    
                                    @error('min')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

    
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
        
      
        @if(count($grades)> 0)
        
        <div  class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded" >
          <div> <h4>List of Grades</h4></div>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Grade</th>
                <th scope="col">Max</th>
                <th scope="col">Min</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
             <?php $count = 1; ?>
             @foreach($grades as $grade)  
              <tr>
              <th scope="row">{{$count++}}</th>
              <td>{{$grade->grade_name}}</td>
              <td>{{$grade->max}}</td>
              <td>{{$grade->min}}</td>
              <td><a href="grades/{{$grade->id}}/edit" class="btn btn-sm btn-primary" style="color:white">Edit</a></td>
              <td>
                <form method="POST" action={{ 'grades/'.$grade->id }}>
                  @csrf
                   {{ csrf_field() }}
                   {{ method_field('DELETE') }}
                <button type="submit"  class="btn btn-sm btn-danger" style="color:white">Delete</button>
                </form>
              </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          @else 
            <div class="container"> <p> No Grade Record</p></div>
        @endif
        </div>
      </div>
    </div>
@endsection