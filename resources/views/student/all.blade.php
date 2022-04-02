@extends('layouts.app')
@section('content')
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