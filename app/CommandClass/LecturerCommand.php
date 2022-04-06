<?php

namespace App\CommandClass;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Hash;

class LecturerCommand
{
    public function addLecturer(Request $request)
    {
        $user = new User();
        $lecturer = new Lecturer();
        $lecturerData = $request->all();
        $this->uploadLecturer($user,$lecturer,$lecturerData);
        return ['success' => true, 'data' => $lecturerData];
    }

    public function updateLecturer(Request $request, $id)
    {
        $user = User::find($id);
        $lecturer = Lecturer::find($id);
        $lecturerData = $request->all();
        $this->uploadLecturer($user,$lecturer,$lecturerData);
        return ['success' => true, 'data' => $lecturerData];
    }

    public function uploadLecturer($user, $lecturer, array $lecturerData)
    {
        $user->name = $lecturerData['name'];
        $user->email = $lecturerData['email'];
        $user->password = Hash::make($lecturerData['password']);
        $user->role = '1';
        $user->save();

        $lecturer->user_id = $user->id;
        $lecturer->course = $lecturerData['title'];
        $lecturer->save();

    }
}
