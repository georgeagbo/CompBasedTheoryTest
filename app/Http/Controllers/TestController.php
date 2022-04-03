<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Result;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function timeOut()
    {
        $user = Course::where('user_id', auth()->user()->id)->first();
        $user->exam_status = '1';
        $user->save();

        Result::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'reg_no' => auth()->user()->reg_no,
            'score' => 0
        ]);
        return view('test.timeout');
    }

    public function submitTest(Request $request){
        // $user = Result::where('user_id',auth()->user()->id)->first();
        // $user->exam_status = '1';
        // $user->save();

        // Result::create([
        //     'user_id' => auth()->user()->id,
        //     'name' => auth()->user()->name,
        //     'reg_no' => auth()->user()->reg_no,
        //     'score' => 0
        // ]);
        return view('test.submit');
        
    }
}
