@extends('layouts.dashboard')
@section('content')
<div class="relative flex items-top justify-center min-h-screen">


    <div class="container-contact100" style="margin-top: 4%;">
        <div class="wrap-contact100">
            <div class="contact100-form validate-form" id="form">
                <span class="contact100-form-title" style="color: steelBlue;">
                    Please Select a course to take exam
                </span>
                <form action="/students/{{auth()->user()->student->id}}/exam" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Assign Course</label>
                        <div class="col-md-8 mb-5">
                            <select class="form-control" id="sel1" name="title" required>
                                <option selected disabled>Select Course</option>
                                <option>Computer Appreciation</option>
                                <option>Computer programming</option>
                                <option>Graphics Design</option>
                                <option>Computer Maintenance</option>
                            </select>
                        </div>

                        <div class="container-contact100-form-btn">
                            <a href="/students/{{auth()->user()->id}}/result">
                                <button class="contact100-form-btn" id="submit">
                                    <span>
                                        Start Exam
                                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                                    </span>
                                </button>
                        </div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection