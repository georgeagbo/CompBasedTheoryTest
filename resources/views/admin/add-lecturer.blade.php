@extends('layouts.app')
@section('content')

@if ($message = Session::get('lecturer'))
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header alert alert-success">{{ $message }}</div>

            <div class="card-body p-2px text-center">
                <div>
                    <span class="text-primary font-weight-bold pb-2">New Lecturer Login Info</span>
                    <p class="pb-2">Copy info and send to lecturer because you will not be able to see it again</p>
                    <div class="ml-5 pl-5">
                        <p class="mb-1 text-left">Name: {{$name ?? ''}} </p>
                        <p class="mb-1 text-left">Email: {{$email ?? ''}} </p>
                        <p class="mb-1 text-left">Password: {{$password ?? ''}} </h>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('New Lecturer') }}</div>

                <div class="card-body">
                    <form method="POST" action="/lecturers">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Assign Course</label>
                            <div class="col-md-3">
                                <select class="form-control" id="sel1" name="title">
                                    <option selected disabled>Select Course</option>
                                    <option>Computer Appreciation</option>
                                    <option>Computer programming</option>
                                    <option>Graphics Design</option>
                                    <option>Computer Maintenance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Assign Exam Duration</label>
                            <div class="col-md-3">
                                <select class="form-control" id="duration" name="exam_duration">
                                    <option selected disabled>Select Duration</option>
                                    <option value="15">15mins</option>
                                    <option value="30">30mins</option>
                                    <option value="45">45mins</option>
                                    <option value="60">1hr</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection