@extends('layouts.app')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!$courses->isEmpty())
            <div class="card mt-5 text-center">
                <div class="card-header">{{ __('Courses') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Title</th>
                                <th scope="col">Unit Load</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$i=0}}
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$course->course_code ?? ''}}</td>
                                <td>{{$course->title ?? ''}}</td>
                                <td>{{$course->unit_load ?? ''}}</td>
                                <td><a href="/courses/{{$course->id}}/edit" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/courses/{{$course->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <h4 class="mt-5 pt-5 text-center">You have not created any course!!</h4>
            @endif
        </div>
    </div>
</div>
@endsection