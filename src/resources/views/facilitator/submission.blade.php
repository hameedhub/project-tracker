@extends('facilitator.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    @if (count($submissions)>0)
        
        <div class="table-responsive">
                <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1; ?>
                                        @foreach ($submissions as $submission)
                                        <tr>
                                        <th scope="row">{{ $num++ }}</th>
                                        <td>{{ $submission->title }}</td>
                                        <td>{{ $submission->first_name }}</td>
                                        <td>{{ $submission->last_name }}</td>
                                        <td><a href="submission/{{$submission->id}}" class="btn btn-sm btn-success" style="color:white">view</button></td>
                                              </tr>
                                        @endforeach
                                 
                </table>
              </div>
    @else
        <p> No assessment submission yet!</p>
    @endif
        
</div>
@endsection