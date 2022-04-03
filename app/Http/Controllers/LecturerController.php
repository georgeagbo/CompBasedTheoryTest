<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = User::Where('role', '1')->get();
        return view('lecturer.all')
            ->with('lecturers', $lecturers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-lecturer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = '';
        $email ='';
        $password ='';
        $lecturers = '';

        $courses = Course::where('title',$request['title'])->first();

        if (!empty($courses)) {
            $request->session()->flash('unsuccesful', $request['title'].' has being assigned to a lecturer');
            return view('admin.add-lecturer');

        }else{
        $duration = intval($request['exam_duration']);
        $name = $request['name'];
        $email =  $request['email'];
        $password = $request['password'];
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => '1'
        ]);

        $course = Course::create([
            'user_id' => $user->id,
            'title' => $request['title'],
            'exam_duration' => $duration,
        ]);

        Lecturer::create([
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);

        $lecturers = User::Where('role', '1')->get();

        $request->session()->flash('lecturer', 'Lecturer Created Succesfully');
    }
        return view('lecturer.all')
            ->with('name', $name)
            ->with('email', $email)
            ->with('password', $password)
            ->with('lecturers',$lecturers);
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
        dd('Lets edit');
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
        dd('Lets update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('Let delete');
    }
}
