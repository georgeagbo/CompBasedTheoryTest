<?php

namespace App\CommandClass;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseCommand
{
    public function addCourse(Request $request)
    {

        $course = new Course();
        $courseData = $request->all();
        $this->uploadCourse($course, $courseData);
        return ['success' => true, 'data' => $courseData];
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::find($id);
        $courseData = $request->all();
    
        $this->uploadCourse($course, $courseData);
        return ['success' => true, 'data' => $courseData];
    }

    public function uploadCourse($course, $courseData)
    {

        $course->title = $courseData['title'];
        $course->course_code = $courseData['course_code'];
        $course->unit_load = $courseData['unit_load'];
        $course->exam_duration = intval($courseData['exam_duration']);
        $course->save();
    }
}
