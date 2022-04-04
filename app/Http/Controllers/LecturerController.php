<?php

namespace App\Http\Controllers;

use App\CommandClass\LecturerCommand;
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
        $email = '';
        $course = '';


        $courses = Course::where('title', $request['title'])->first();

        if (!empty($courses)) {
            $request->session()->flash('unsuccesful', $request['title'] . ' has being assigned to a lecturer');
            return view('admin.add-lecturer');
        } else {
            $lecturerCommand = (new LecturerCommand())->addLecturer($request);

            if ($lecturerCommand['success'] = true) {

                $name = $request['name'];
                $email = $request['email'];
                $course = $request['course'];

                $request->session()->flash('lecturer', 'Lecturer information successfully updated');
                return redirect('/lecturers')
                ->with([
                    'name' => $name,
                    'email' => $email,
                    'course' => $course
                ]);
            }
        }
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
        $lecturer = User::find($id);
        return view('admin.edit-lecturer')
            ->with('lecturer', $lecturer);
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
        $course = Course::where('title', $request['title']);
        
        if ($course->exists() && $course->first()->user_id != $id) {
            $request->session()->flash('unsuccesful', $request['title'] . ' has being assigned to a lecturer');
            return back();
        } else {

            (new LecturerCommand())->updateLecturer($request, $id);
            $request->session()->flash('status', 'Lecturer successfully updated ');
                return redirect('/lecturers');
            }
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecturer = User::find($id);
        $lecturer->delete();
        session()->flash('status', 'lecturer deleted sucessfully');
        return back();
    }
}
