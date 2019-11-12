<?php

namespace App\Http\Controllers\Facilitator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;

class DashboardController extends Controller
{
   public function __construct (){
      $this->middleware('auth');
  }
  
   public function index($id){
       $course = Course::orderBy('created_at', 'desc')->where('facilitator_id', $id)->take(3)->get();
        return view('facilitator.dashboard')->with('courses', $course);
   }
   
}
