@extends('layouts.app')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

@if ($message = Session::get('student'))
<div class="row justify-content-center">
    <div class="col-md-4 mb-5">
        <div class="card">
            <div class="card-header alert alert-success">{{ $message }}</div>

            <div class="card-body p-2px text-center">
                <div>
                    <span class="text-primary font-weight-bold pb-2">New student Login Info</span>
                    <p class="pb-2">Copy info and send to student because you will not be able to see it again</p>
                    <div class="ml-5 pl-5">
                        <p class="mb-1 text-left">Name: {{$name ?? ''}} </p>
                        <p class="mb-1 text-left">Email: {{$email ?? ''}} </p>
                        <p class="mb-1 text-left">Reg No: {{$regNo ?? ''}} </p>
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
            @if(!$students->isEmpty())
            <div class="card mt-5 text-center">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Reg No</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{$student->id ?? ''}}</td>
                                <td>{{$student->name ?? ''}}</td>
                                <td>{{$student->email ?? ''}}</td>
                                <td>{{$student->student->reg_no ?? ''}}</td>
                                <td><a href="/students/{{$student->id}}/edit" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/students/{{$student->id}}" method="post">
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
                @else
                <h4 class="mt-5 pt-5 text-center">You have not created any student!!</h4>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection