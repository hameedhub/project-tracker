@extends('facilitator.layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
        {{-- <h6 class="border-bottom border-gray pb-2 mb-0">Available Courses</h6> --}}
        
 <div class="accordion" id="accordionExample">
   <div class="card">
     <div class="card-header" id="headingOne">
       <h2 class="mb-0">
         <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           {{$course->title}}
         </button>
       </h2>
     </div>
 
     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
       <div class="card-body">
        <?php echo html_entity_decode($course->description); ?>
       </div>
     </div>
   </div>
   <div class="card">
     <div class="card-header" id="headingTwo">
       <h2 class="mb-0">
         <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           Objectives
         </button>
       </h2>
     </div>
     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
       <div class="card-body">
         <?php echo html_entity_decode($course->objectives) ?>
       </div>
     </div>
   </div>
   
   </div>

 </div>

 

 </div>    
@endsection