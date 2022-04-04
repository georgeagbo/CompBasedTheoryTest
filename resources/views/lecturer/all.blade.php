@extends('layouts.app')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

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
                        <p class="mb-1 text-left">Name: {{$name}} </p>
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
            @if(!$lecturers->isEmpty())
            <div class="card mt-5 text-center">
                <div class="card-header">{{ __('Lecturers') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Course</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($lecturers as $lecturer)
                            <tr>
                                <td>{{$lecturer->id ?? ''}}</td>
                                <td>{{$lecturer->name ?? ''}}</td>
                                <td>{{$lecturer->email ?? ''}}</td>
                                <td>{{$lecturer->course->title ?? ''}}</td>
                                <td><a href="/lecturers/{{$lecturer->id}}/edit" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/lecturers/{{$lecturer->id}}" method="post">
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
            <h4 class="mt-5 pt-5 text-center">You have not created any lecturer!!</h4>
            @endif
        </div>
    </div>
</div>
@endsection