<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Submission;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $this->validate($request,[
            'solution' => ['required', 'min:2'],
        ]);

        $submission = new Submission();
        $submission->solution = $request->input('solution');
        $submission->note = $request->input('note');
        $submission->course_id = $request->input('course_id');
        $submission->assessment_id = $request->input('assessment_id');
        $submission->student_id = $request->input('student_id');
        $submission->save();
        return redirect('student/assessment/'.$request->input('assessment_id'))->with('success', 'Your submission has been sent successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $this->validate($request,[
            'solution' => ['required', 'min:2'],
        ]);

        $submission = Submission::find($id);
        $submission->solution = $request->input('solution');
        $submission->note = $request->input('note');
        $submission->course_id = $request->input('course_id');
        $submission->assessment_id = $request->input('assessment_id');
        $submission->student_id = $request->input('student_id');
        $submission->save();
        return redirect('student/assessment/'.$request->input('assessment_id'))->with('success', 'Your submission was updated successfully!');
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
