@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card mt-5">
                <div class="card-header">{{ __('New Course') }}</div>

                <div class="card-body">
                    <form method="POST" action="/courses">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Course Code') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('course_code') is-invalid @enderror" name="course_code" value="{{ old('course_code') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Course Title') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Load') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="number" class="form-control @error('unit_load') is-invalid @enderror" name="unit_load" value="{{ old('unit_load') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Exam Duration') }}</label>
                            <div class="col-md-6">
                                <input id="exam_duration" type="number" class="form-control @error('exam_duration') is-invalid @enderror" name="exam_duration" value="{{ old('exam_duration') }}" required autocomplete="name" autofocus placeholder="E.g 90mins">

                                @error('name')
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