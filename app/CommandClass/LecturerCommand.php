<?php

namespace App\CommandClass;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class LecturerCommand
{
    public function addLecturer(Request $request)
    {
        $user = new User();
        $lecturerCourse = new Course();
        $lecturerData = $request->all();
        $this->uploadLecturer($user, $lecturerCourse, $lecturerData);
        return ['success' => true, 'data' => $lecturerData];
    }

    public function updateLecturer(Request $request, $id)
    {
        $user = User::find($id);
        $lecturerCourse = Course::where('user_id', $user->id)->first();
        $lecturerData = $request->all();
        $this->uploadLecturer($user, $lecturerCourse, $lecturerData);
        return ['success' => true, 'data' => $lecturerData];
    }

    public function uploadLecturer($user, $lecturerCourse, array $lecturerData)
    {
        $user->name = $lecturerData['name'];
        $user->email = $lecturerData['email'];
        $user->password = Hash::make($lecturerData['password']);
        $user->role = '1';
        $user->save();

        $lecturerCourse->user_id = $user->id;
        $lecturerCourse->title = $lecturerData['title'];
        $lecturerCourse->exam_duration = intval($lecturerData['exam_duration']);
        $lecturerCourse->save();
    }
}
