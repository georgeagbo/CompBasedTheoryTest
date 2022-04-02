<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function timeOut()
    {
        $user = User::find(auth()->user()->id);
        $user->test_status = '1';
        $user->save();

        Result::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'reg_no' => auth()->user()->reg_no,
            'score' => 0
        ]);
        return view('test.timeout');
    }

    public function submitTest(){
        $user = User::find(auth()->user()->id);
        $user->test_status = '1';
        $user->save();

        // Result::create([
        //     'user_id' => auth()->user()->id,
        //     'name' => auth()->user()->name,
        //     'reg_no' => auth()->user()->reg_no,
        //     'score' => 0
        // ]);
        return view('test.submit');
    }
}
