<?php

namespace App\Http\Controllers\Facilitator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Material;
use App\Course;

class MaterialController extends Controller
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
        $course = Course::where('facilitator_id', $user_id)->pluck('id');
        $materials = Material::whereIn('course_id', $course)
        ->orderBy('created_at', 'desc')->paginate(10);;

        return view('facilitator.material')->with('materials', $materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $course = Course::where('facilitator_id',$user_id )->get();
        return view('facilitator.material_add')->with('courses', $course);
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
            'title'=> ['required', 'min:3', 'max:150', 'unique:materials'],
            'description'=> ['required', 'min:5', 'max:255'],
            'file'=> ['required']
        ]);
        if($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('file')->getClientOriginalExtension();
            $name = $filename.'_'.time().'.'.$ext;
            $path = $request->file('file')->storeAs('public/materials', $name);

        }

       $material = new Material;
       $material->course_id = $request->input('course_id');
       $material->title = $request->input('title');
       $material->path = $name;
       $material->description = $request->input('description');
       $material->facilitator_id = auth()->user()->id;
       $material->save();    

       return back()->with('success', 'Material was successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $material = Material::find($id);
        $courses = Course::where('facilitator_id', $user_id)->get();
        $course = Course::where('id', $material->course_id)->get();
       return view('facilitator.material_edit')->with(array(
           'material'=>$material,
           'course' => $course,
           'courses'=> $courses
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
        $this->validate($request, [
            'course_id'=>['required'],
            'title'=> ['required', 'min:3', 'max:150'],
            'description'=> ['required', 'min:5', 'max:255'],
        ]);
        $material = Material::find($id);

        if($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('file')->getClientOriginalExtension();
            $name = $filename.'_'.time().'.'.$ext;
            $path = $request->file('file')->storeAs('public/materials', $name);

        }

       $material->course_id = $request->input('course_id');
       $material->title = $request->input('title');
       if($request->hasFile('file')){
        $material->path = $name;
       }
       $material->description = $request->input('description');
       $material->save();    

       return back()->with('success', 'Material was successfully udpated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $material = Material::destroy($id);
       return back()->with('success', 'Material was successfully deleted!');
    }
}
