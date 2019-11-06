@extends('layouts.app')

@section('content')


    <div class="container">

        
        @if(count($grades)> 0)
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Grade</th>
                <th scope="col">Max</th>
                <th scope="col">Min</th>
              </tr>
            </thead>
            <tbody>
             <?php $count = 1; ?>
             @foreach($grades as $grade)  
              <tr>
              <th scope="row">{{$count++}}</th>
              <td>{{$grade->grade_name}}</td>
              <td>{{$grade->highest}}</td>
              <td>{{$grade->lowest}}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          @else 
            <div class="container"> <p> No Grade Record</p></div>
        @endif
    </div>
@endsection