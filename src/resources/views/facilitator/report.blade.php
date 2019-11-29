@extends('student.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <?php $num = 1; ?>
    @if (count($reports)>0)
    
    <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Assessment</th>
                <th scope="col">Grade</th>
                <th scope="col">Facilitator</th>
                <th scope="col">Remark</th>
              </tr>
            </thead>
            <tbody>
                    @foreach ($reports as $report)
              <tr>
              <th scope="row">{{ $num++}}</th>
              <td>{{ $report->title}}</td>
              <td>{{ $report->score}}/{{$report->max}}</td>
              <td>{{ $report->first_name  .' '.$report->last_name}}</td>
              <td>{{ $report->remark }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    
    
    @else
          <p> No available report</p>
    @endif


</div>
@endsection