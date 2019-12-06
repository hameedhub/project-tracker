<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Set;
use App\User;
use DB;

class SetController extends Controller
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
        $sets = Set::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.set')->with(array('sets'=> $sets));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.set_add');

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
            'title' => ['required', 'min:2', 'max:200', 'unique:sets']
        ]);
        $set = new Set();
        $set->title = $request->input('title');
        $set->save();
        return redirect('admin/set/create')->with('success', 'Set was successfully added');

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
        //
        $set = Set::find($id);

        $student = User::where('set_id', '=', $id)->orderBy('created_at', 'desc')->paginate(10);
        $names = User::where('set_id', '=', $id)->orderBy('created_at', 'desc')->pluck('first_name');
         $ids = User::where('set_id', '=', $id)->orderBy('created_at', 'desc')->pluck('id');
        
         $arr_score = [];
         foreach($ids as $id){
           $sql = 'SELECT SUM(score) as score FROM reports WHERE student_id =:student_id';
             $result = DB::select($sql,['student_id'=>$id]);
            array_push($arr_score, (int)$result[0]->score);
         }
        $arr_score;
        return view('admin.set_edit')->with(array(
            'set'=> $set,
            'students'=> $student,
            'names'=> $names,
            'scores'=> $arr_score
        ));
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
            'title' => ['required', 'min:2', 'max:200', 'unique:sets']
        ]);
        $set = Set::find($id);
        $set->title = $request->input('title');
        $set->save();
        return redirect('admin/set/'.$id.'/edit')->with('success', 'Set was successfully updated!');
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
