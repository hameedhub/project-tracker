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
                <form method="POST" action="{{ route('set.update', ['id' => $set->id] ) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="grade_name" class="col-md-2 col-form-label text-md-right">{{ __('Set Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $set->title }}" required>

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


                </div>
               
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <canvas id="bar-chart" width="800" height="450"></canvas>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script>
          new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: <?php echo $names ?> ,
      datasets: [
        {
          label: "Students Name",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: <?php echo '['.implode(',',$scores) .', 1000]' ?>
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Student Assessment Graph'
      }
    }
});

        </script>
        <div class="my-3 p-3 bg-white rounded shadow-sm">

                {{-- <h6 class=" border-gray pb-2 mb-0">Courses</h6> --}}
                    <div class="border-bottom  ">
                    <a >Students</a>
                    </div>
                
                @if(count($students)>0)
                @foreach ($students as $student)
                    
                  
                  <div class="media text-muted pt-3">
                    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                      <div class="d-flex justify-content-between align-items-center w-100">
                      <strong class="text-gray-dark">{{ $student->first_name .' '. $student->last_name }}</strong>
                      </div>
                    <span class="d-block"> {{ $student->email}} </span>
                    </div>
                  </div>
                </a>
                @endforeach
                
                <small class="d-block text-right mt-3">
                  {{$students->links()}}
                </small>
                @else
                <p> No Student on this set </p>
                @endif
              </div>  

             
@endsection