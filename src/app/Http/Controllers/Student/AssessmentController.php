<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Assessment;
use App\Submission;
use DB;

class AssessmentController extends Controller
{
    public function __construct (){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        
        $course = DB::table('registrations')
        ->join('courses', 'courses.id', '=', 'registrations.course_id')
        ->where(['registrations.student_id'=>$user_id, 'registrations.status'=> 1])
        ->pluck('registrations.course_id');

        $assessments = Assessment::whereIn('course_id', $course)->orderBy('created_at', 'desc')->get();
        return view('student.assessment')->with('assessments', $assessments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $assessment = Assessment::find($id);
        $submission = Submission::where([
            'assessment_id'=> $assessment->id,
            'student_id' => auth()->user()->id
        ])->get();
        
        return view('student.assessment_view')->with(array(
            'assessment'=>$assessment,
            'submission' => $submission
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
