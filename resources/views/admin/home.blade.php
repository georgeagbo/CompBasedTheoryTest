@extends('layouts.app')
@section('content')

@if(auth()->user()->role == '2')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">{{ __('Uploaded Questions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="grid">
                        <div class="row">
                            <div class='col-md-4'>Course</div>
                            <div class='col-md-4'>Questions</div>
                            <div class='col-md-4'>Actions</div>
                        </div>
                        @foreach($questions as $question)
                        <div class="row border border-bottom-0 border-left-0 border-right-0 pb-1 pt-1">
                            <div class='col-md-4'>{{$question->course?? ''}}</div>
                            <div class='col-md-4'>{{$question->question}}</div>
                            <div class='col-xs-2'><a href="/edit/question/{{$question->id}}" class="btn btn-warning btn-sm mr-2">Edit</a></div>
                            <div class='col-xs-2'>
                                <form action="/question/delete/{{$question->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm delete">
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container-contact100" style="margin-top: -35px;">
                        <div class="wrap-contact100">
                            <form class="contact100-form validate-form" action="/store" method="post">
                                @csrf
                                <span class="contact100-form-title">
                                    Upload Questions
                                </span>
                                @if (session('errors'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('errors')->first('error')}}

                                </div>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" id="closes" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure You Wish To Delete Answer
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                                <button type="button" class="btn btn-primary btn-delete-input">YES</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="container">
                                    <div id="iq">
                                        <div class="row mb-5">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Course</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="course" name="course">
                                                    <option selected disabled>Select Course</option>
                                                    @foreach($courses as $course)
                                                    <option value="{{$course->title}}">{{$course->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <label class="label-input100" for="message">Enter Question</label>
                                        <div class="row">
                                            <div class="wrap-input100 validate-input">

                                                <textarea id="message" cols="50" rows="5" name="question" placeholder="Please Enter Your Question" required></textarea>
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div><label class="label-input100" for="answer">Answers*</label><span>seperate points with semicolon ';'</div>

                                        </div>
                                        <div class="row">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <textarea id="answer_0" cols="35" rows="2" type="text" name="answer_0" placeholder="Part Answer" required></textarea>
                                                            <span class="focus-input100"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <input style="width:100%; height:50px" type="number" step="0.01" name="mark_0" placeholder="E.g 0.5" required>
                                                            <span class="focus-input100"></span>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="btn btn-light btn-sm" id="add-answer" value="Add more answers" required>

                                    <label class="label-input100" for="marks_obtainable" style="margin-top: 4%;">Marks obtainable</label>

                                    <div class="wrap-input100 validate-input">
                                        <input id="marks_obtainable" class="input100" type="number" name="marks_obtainable" placeholder="Marks Obtainable" required>
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                                <div class="container-contact100-form-btn">
                                    <button class="contact100-form-btn">
                                        <span>
                                            Submit
                                            <i class="zmdi zmdi-arrow-right m-l-8"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
                <script>
                    window.dataLayer = window.dataLayer || [];

                    function gtag() {
                        dataLayer.push(arguments);
                    }
                    gtag('js', new Date());

                    gtag('config', 'UA-23581568-13');
                </script>

                <script>
                    $(document).ready(function() {

                        $('.delete').on('click', function(e) {
                            var answer = confirm('Do you want to delete?');
                            if (answer) {
                                //alert('Deleted');
                            } else {
                                e.preventDefault();
                            }
                        });

                        let wrapper = $("#iq");
                        let i = 0;
                        $("#add-answer").click(function() {
                            i = i + 1;
                            $(wrapper).append(`
                            <div>
                              <div class="row">
                                <div>
                                  <div class="row" id="row_${i}">
                                    <div class="col-md-9">
                                      <div class="wrap-input100 rs validate-input">
                                        <textarea id="answer_${i}" type="text" name="answer_${i}" placeholder="Part Answer" cols="35" rows="2" class="answer" required></textarea>
                                        <span class="focus-input100"></span>
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="wrap-input100 rs validate-input">
                                        <input id="mark_${i}" type="number" step="0.01" name="mark_${i}" style="width:100%; height:50px" required>
                                        <span class="focus-input100"></span>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <input type="button" id="remove_${i}" class="btn btn-danger btn-sm remove_field" value="x">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            `);

                        });


                        $(".row").on("click", ".remove_field", function(e) {
                            const id = e.target.id;
                            const rowId = id.substring(id.indexOf("_"));
                            console.log(rowId);

                            $inputValue = $(`#answer${rowId}`).val();



                            if ($inputValue !== "") {
                                console.log(this)
                                //$(this).attr("data-toggle", "modal").attr("data-target", "#staticBackdrop");
                                $("#staticBackdrop").modal('show')

                                $("#staticBackdrop").on("click", ".btn-delete-input", function() {
                                    $(`#row${rowId}`).remove();
                                    $("#staticBackdrop").modal('hide')
                                })
                            } else {
                                $(`#row${rowId}`).remove();

                            }

                        });
                    });
                </script>
            </div>
        </div>
    </div>

</div>
@endif
@endsection