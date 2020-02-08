<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Course;
use App\Assessment;
use App\Grade;
use App\Submission;
use App\Registration;
use DB;
use App\Set;

class UsersController extends Controller
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
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.users')->with('users', $users);
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
    public function change($id, $reg_id){
        $reg = Registration::find($reg_id);
         if($reg['status'] === 0){
            $reg->status = 1;
            $reg->save();
         }else{
             $reg->status = 0;
             $reg->save();
         }
       return redirect('admin/users/'.$id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $status)
    {
       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);

        $course = '';
        $assessment = '';
        $set = Set::all();

        // facilitator
        if($data->role_id == 2){
            $course = Course::where('facilitator_id', '=', $data->id)->get();
            $assessment = Assessment::where('facilitator_id', '=', $data->id)->get();


        // student
        }elseif($data->role_id == 3){
           $reg = DB::table('registrations')
            ->join('courses', 'courses.id', '=', 'registrations.course_id')
            ->where('registrations.student_id',$data->id)
            ->pluck('registrations.course_id');

            $course = DB::table('registrations')
           ->join('courses', 'courses.id', '=', 'registrations.course_id')
           ->whereIn('courses.id', $reg)
           ->select('registrations.student_id','registrations.id as  reg_id', 'registrations.status',
            'courses.title', 'courses.description'
           )
           ->get();
           
            $assessment =DB::table('assessments')
            ->join('reports', 'assessments.id', '=', 'reports.assessment_id')
            ->join('grades', 'grades.id', '=', 'reports.grade_id')
            ->where('reports.student_id', $data->id)
            ->get(); 
        }
        

        return view('admin.users_edit')->with(
            array('user' => $data, 
            'courses'=>$course, 
            'assessments'=> $assessment,
            'sets' => $set)
        );
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
    
        $user = User::find($id);
        $user->role_id = $request->input('role_id');
        $user->set_id = $request->input('set_id');
        $user->save();
        return redirect('admin/users/'.$id.'/edit')->with('success', 'User was successfully updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User
        $user = User::find($id);
        $user->destroy($id);

        return redirect('admin/users');
    }
}
