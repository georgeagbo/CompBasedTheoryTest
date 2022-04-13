@extends('layouts.dashboard')
@section('content')

<div style="margin-top: 4%;">
    <div class="wrap-contact100">
        <div>
            <h1 class="text-center mb-3 text-danger">You must write a test to have a result</h1>
        </div>
        <div class="container-contact100-form-btn mt-3">
            <a href="/students/{{auth()->user()->student->id}}/select-course">
                <button class="contact100-form-btn">
                    <span>
                        Start Test
                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                    </span>
                </button>
            </a>
        </div>
        </a>
    </div>
</div>

@endsection