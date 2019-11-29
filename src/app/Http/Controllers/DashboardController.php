<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Course;
use App\Assessment;
use DB;
use App\Set;

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
          return view('home');
      }else if(auth()->user()->role_id == 3 ){

        $user_id = auth()->user()->id;
        $courses = DB::table('registrations')
        ->join('courses', 'courses.id', '=', 'registrations.course_id')
        ->where(['registrations.student_id'=> $user_id, 'registrations.status'=> 1 ])
        ->select('courses.title', 'courses.id', 'courses.description')
        ->orderBy('registrations.created_at', 'desc')
        ->paginate(5);

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
        ->paginate(3);
        
        return view('student.dashboard')->with(
            array('courses'=> $courses,
            'assessments' => $assessments
        ));
      }else if(auth()->user()->role_id == 2){
        $user_id = auth()->user()->id;
        $courses = Course::where('facilitator_id', '=', $user_id)
                    ->orderBy('created_at', 'desc')->take(3)->get();
        
        $assessments = Assessment::where('facilitator_id', $user_id)->pluck('id');
        $submission = DB::table('submissions')
                    ->join('users', 'users.id', '=', 'submissions.student_id')
                    ->join('assessments', 'assessments.id', '=', 'assessment_id')
                    ->whereIn('submissions.assessment_id', $assessments )
                     ->select('users.first_name', 'users.last_name',
                    'assessments.title', 'submissions.id', 'submissions.access')
                    ->orderBy('submissions.created_at', 'desc')
                    ->get();

         return view('facilitator.dashboard')->with(array('courses'=>$courses, 'submissions'=> $submission));
      }
      else if(auth()->user()->role_id == 1){
        $sets = Set::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.dashboard')->with('sets', $sets);
      }

    }
    public function profile(){
      return view('student.profile');

    }
}
