<?php

namespace App\Http\Controllers\Facilitator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Submission;
use App\Assessment;
use App\Course;
use DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('facilitator_id', 1)->pluck('id');
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
        $submission = DB::table('submissions')
                        ->join('users', 'users.id', '=', 'submissions.student_id')
                        ->join('assessments', 'assessments.id', '=', 'assessment_id')
                        ->where('submissions.id', $id )
                        ->select('users.first_name', 'users.last_name',
                         'assessments.title', 'assessments.question',
                          'submissions.id', 'submissions.solution', 'submissions.note',
                          'submissions.updated_at', 'submissions.created_at')
                         ->get();
        return view('facilitator.submission_view')->with('submission', $submission);
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
