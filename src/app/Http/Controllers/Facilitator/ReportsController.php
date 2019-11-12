<?php

namespace App\Http\Controllers\Facilitator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Submission;
use App\Assessment;
use App\Course;
use App\Grade;
use App\Report;
use DB;

class ReportsController extends Controller
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
        $courses = Course::where('facilitator_id', $user_id)->pluck('id');
        $submission = DB::table('submissions')
                        ->join('users', 'users.id', '=', 'submissions.student_id')
                        ->join('assessments', 'assessments.id', '=', 'assessment_id')
                        ->whereIn('submissions.course_id', $courses )
                        ->select('users.first_name', 'users.last_name',
                         'assessments.title', 'submissions.id')
                         ->orderBy('submissions.created_at', 'desc')
                         ->get();

        return view('facilitator.submission')->with('submissions', $submission);
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
        $this->validate($request, [
            'assessment_id' => ['required'],
            'student_id'=> ['required'],
            'grade_id' => ['required'],
            'score' => ['required'],
            'remark' => ['required'],
        ]);

        $report = new Report();
        $report->assessment_id = $request->input('assessment_id');
        $report->submission_id = $request->input('id');
        $report->student_id = $request->input('student_id');
        $report->grade_id = $request->input('grade_id');
        $report->score = $request->input('score');
        $report->remark = $request->input('remark');
        $report->facilitator_id = 1;
        $report->save();
        return redirect('facilitator/submitted/'.$request->id)->with(
            'success', 'Grade was successfuly saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grades = Grade::all();
        $action = '';
        $submission = DB::table('submissions')
                        ->join('users', 'users.id', '=', 'submissions.student_id')
                        ->join('assessments', 'assessments.id', '=', 'submissions.assessment_id')
                        ->where('submissions.id', $id )
                        ->select('users.first_name', 'users.last_name',
                         'assessments.title', 'assessments.question',
                          'submissions.id', 'submissions.solution', 'submissions.note',
                          'submissions.student_id', 'submissions.assessment_id',
                          'submissions.updated_at', 'submissions.created_at')
                         ->get();
        $grade='';
        $report = Report::where([
            'submission_id'=> $submission[0]->id,
            'student_id'=> $submission[0]->student_id
                        ])->get();
        if(count($report)>0){
            $grade = Grade::find($report[0]->grade_id);
        };
        return view('facilitator.submission_view')->with(
            array('submission'=> $submission, 'grades'=> $grades, 'report'=>$report,
             'grade'=> $grade));
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
        $this->validate($request, [
            'assessment_id' => ['required'],
            'grade_id' => ['required'],
            'score' => ['required'],
            'remark' => ['required'],
        ]);

        $report = Report::find($id);
        $report->grade_id = $request->input('grade_id');
        $report->score = $request->input('score');
        $report->remark = $request->input('remark');
        $report->save();
        return redirect('facilitator/submitted/'.$request->id)->with(
            'success', 'Grade was successfuly updated');
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
