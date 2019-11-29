<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Course;
use App\Assessment;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(auth()->user()->role_id == 0){
          return "Hello";
      }else if(auth()->user()->role_id == 3 ){

        $user_id = auth()->user()->id;
        $courses = DB::table('registrations')
        ->join('courses', 'courses.id', '=', 'registrations.student_id')
        ->where('registrations.student_id',$user_id)
        ->select('courses.title', 'courses.id', 'courses.description')
        ->orderBy('registrations.created_at', 'desc')
        ->take(3)->get();

        $course = DB::table('registrations')
        ->join('courses', 'courses.id', '=', 'registrations.student_id')
        ->where('registrations.student_id',$user_id)
        ->pluck('registrations.course_id');

        $assessments = DB::table('assessments')
        ->join('courses', 'courses.id', '=', 'assessments.course_id')
        ->join('users', 'users.id', '=', 'assessments.facilitator_id')
        ->whereIn('assessments.course_id',$course)
        ->select('assessments.title', 'assessments.id', 'users.first_name', 'users.last_name')
        ->orderBy('assessments.created_at', 'desc')
        ->take(3)->get();
        
        return view('student.dashboard')->with(
            array('courses'=> $courses,
            'assessments' => $assessments
        ));
      }else if(auth()->user()->role_id == 2){
        $user_id = auth()->user()->id;
        $courses = Course::where('facilitator_id', '=', $user_id)
                    ->orderBy('created_at', 'desc')->take(3)->get();
        
        $course = Course::where('facilitator_id', $user_id)->pluck('id');
        $submission = DB::table('submissions')
                    ->join('users', 'users.id', '=', 'submissions.student_id')
                    ->join('assessments', 'assessments.id', '=', 'assessment_id')
                    ->whereIn('submissions.course_id', $courses )
                     ->select('users.first_name', 'users.last_name',
                    'assessments.title', 'submissions.id')
                    ->orderBy('submissions.created_at', 'desc')
                    ->get();

         return view('facilitator.dashboard')->with(array('courses'=>$courses, 'submissions'=> $submission));
      }
      else if(auth()->user()->role_id == 1){
        return view('admin.dashboard');
      }

    }
    public function profile(){
      return view('student.profile');

    }
}
