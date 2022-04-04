<?php

namespace App\Http\Controllers;

use App\CommandClass\StudentCommand;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = User::Where('role', '0')->get();
        return view('student.all')
            ->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = (new StudentCommand())->addStudent($request);

        if ($student["success"] == true) {

            $name = $request['name'];
            $email = $request['email'];
            $regNo = $request['regNo'];
            $password = $request['password'];
            $students = User::Where('role', '0')->get();
            $request->session()->flash('student', 'Student Created Succesfully');

            return view('student.all')
                ->with('name', $name)
                ->with('email', $email)
                ->with('regNo', $regNo)
                ->with('password', $password)
                ->with('students', $students);
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
        $student = User::find($id);
        return view('admin.edit-student')
            ->with('student', $student);
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
        $studentCommand = (new StudentCommand())->updateStudent($request, $id);
        if ($studentCommand['success'] == true) {
            $name = $request['name'];
            $email = $request['email'];
            $password = $request['password'];
            $regNo = $request['regNo'];

            $request->session()->flash('status', 'Student information successfully updated');
            return redirect('/students')
                ->with([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'regNo' => $regNo
                ]);
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
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
