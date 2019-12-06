<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grade;

class GradesController extends Controller
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
        $grades = Grade::orderBy('created_at', 'desc')->get();
        return view('admin.grade')->with('grades', $grades);
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
            'grade_name' => 'required',
            'max' => 'required',
            'min' => 'required'
        ]);

        $grade = new Grade;
        $grade->grade_name = $request->input('grade_name');
        $grade->max = $request->input('max');
        $grade->min = $request->input('min');
        $grade->save();
        return redirect('admin/grades')->with('success', 'Grade was successfully saved');
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
        $action = route('grades.update', ['id' => $id]);
        $grade = Grade::find($id);
        $grades = Grade::orderBy('created_at', 'desc')->get();
       return view('admin.grade_edit')->with(array('grade'=>$grade, 
       'grades'=>$grades, 'action'=> $action));
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
        $grade = Grade::find($id);
        $grade->grade_name = $request->input('grade_name');
        $grade->max = $request->input('max');
        $grade->min = $request->input('min');
        $grade->save();
        return redirect('admin/grades')->with('success', 'Grade was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = route('grades.destroy',['id', $id]);
        $grade = Grade::find($id);
        $grade->destroy($id);
        return redirect('admin/grades');
    }
}
