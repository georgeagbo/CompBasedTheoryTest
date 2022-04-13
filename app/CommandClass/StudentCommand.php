<?php

namespace App\CommandClass;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentCommand
{
    public function addStudent(Request $request)
    {
        $user = new User();
        $student = new Student;
        $studenData = $request->all();
        $this->uploadStudent($studenData, $user, $student);
        return ['success' => true, 'data' => $studenData];
    }

    public function updateStudent(Request $request, int $id)
    {
        $user = User::find($id);
        $student = Student::where('user_id', $id)->first();
        $studenData = $request->all();
        $this->uploadStudent($studenData, $user, $student);
        return ['success' => true, 'data' => $studenData];
    }


    public function uploadStudent($studenData, $user, $student)
    {
        $user->name = $studenData['name'];
        $user->email = $studenData['email'];
        $user->password = Hash::make($studenData['password']);
        $user->role = '0';
        $user->save();
        
        $student->user_id = $user->id;
        $student->reg_no = $studenData['regNo'];
        $student->save();
    }
}
