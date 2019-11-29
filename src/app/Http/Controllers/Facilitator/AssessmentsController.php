<?php

namespace App\Http\Controllers\Facilitator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Assessment;
use DB;

class AssessmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $assessments = DB::table('assessments')
        // ->join('courses', function($join){
        //     $join->on('assessments.course_id', '=', 'courses.id')
        //     ->where('assessments.facilitator_id', '=', 1)
        //     ->selectRaw('*, c');
        // })->get();
        $assessments = Assessment::where('facilitator_id', '1')->orderBy('created_at', 'desc')->get();
       return view('facilitator.assessment')->with('assessments', $assessments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::where('facilitator_id', 1)->get();
        return view('facilitator.assessment_add')->with('courses', $course);
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
            'course_id'=>['required'],
            'title'=> ['required', 'min:3', 'max:255'],
            'instruction'=> ['required', 'min:5'],
            'question'=> ['required', 'min:10'],
        ]);
        $assessment = new Assessment();
        $assessment->title = $request->input('title');
        $assessment->instruction = $request->input('instruction');
        $assessment->question = $request->input('question');
        $assessment->due_date = $request->input('due_date');
        $assessment->course_id = $request->input('course_id');
        $assessment->facilitator_id = 1;
        $assessment->save();

        return redirect('facilitator.assessment');
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
        $action = route('assessment.update', ['id'=> $id]);
        $courses = Course::where('facilitator_id', 1)->get();
        $assessment = Assessment::find($id);
        $course = Course::where('id', $assessment->course_id)->get();
        return view('facilitator.assessment_edit')->with(array(
        'assessment'=> $assessment,
        'courses'=> $courses,
        'course'=> $course,
         'action'=> $action));
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
            'course_id'=>['required'],
            'title'=> ['required', 'min:3', 'max:255'],
            'instruction'=> ['required', 'min:5'],
            'question'=> ['required', 'min:10'],
        ]);
        $assessment =  Assessment::find($id);
        $assessment->title = $request->input('title');
        $assessment->instruction = $request->input('instruction');
        $assessment->question = $request->input('question');
        $assessment->due_date = $request->input('due_date');
        $assessment->course_id = $request->input('course_id');
        $assessment->facilitator_id = 1;
        $assessment->save();

        return redirect('facilitator/assessment/'.$id.'/edit');
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
