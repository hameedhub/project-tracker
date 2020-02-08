<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Course;
use App\User;

class CoursesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         
       $facilitators = User::where('role_id', '=', 2)->get();
        $course = DB::table('courses')
        ->join('users', 'users.id', '=', 'courses.facilitator_id')
        ->select('users.first_name', 'users.last_name', 'courses.id', 'courses.title', 'courses.description')
        ->get();
       return view('admin.courses')->with(array(
           'facilitators'=> $facilitators,
           'courses'=> $course
    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilitators = User::where('role_id', '=', 2)->get();
        $course = Course::orderBy('created_at', 'desc')->get();
       return view('admin.course_add')->with(array(
           'facilitators'=> $facilitators,
           'courses'=> $course
    ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' =>['required', 'min:10', 'max:255'],
            'objectives' => ['required', 'string', 'min:10'],
            'facilitator_id'=> ['required']
        ]);
        
        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->objectives = $request->input('objectives');
        $course->facilitator_id = $request->input('facilitator_id');
        $course->save();
        return redirect('admin/courses/create')->with('success', 'Course was successfully added');
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
        $facilitators = User::where('role_id', '=', 2)->get();
        $action = route('courses.update', ['id'=> $id]);
        $course = DB::table('courses')
        ->join('users', 'users.id', '=', 'courses.facilitator_id')
        ->where('courses.id', '=', $id)
        ->select('users.first_name', 'users.last_name', 'courses.id', 
        'courses.title', 'courses.description', 'courses.objectives',
        'courses.facilitator_id'
        )
        ->get();


       return view('admin.course_edit')->with(array('action'=> $action, 'course' =>$course, 'facilitators'=> $facilitators));
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
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' =>['required', 'min:10', 'max:255'],
            'objectives' => ['required', 'string', 'min:10'],
            'facilitator_id'=> ['required']
        ]);

        $course = Course::find($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->objectives = $request->input('objectives');
        $course->facilitator_id = $request->input('facilitator_id');
        $course->save();
        return redirect('admin/courses/'.$id.'/edit')->with('success', 'Course was successfully updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->destroy($id);

        return redirect('admin/courses');
        
    }
}
