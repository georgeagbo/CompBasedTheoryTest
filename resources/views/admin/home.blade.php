@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Uploaded Questions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                            <tr>
                                <td>{{$question->question}}</td>
                                <td><a href="/edit/question/{{$question->id}}" class="btn btn-light btn-sm">Edit</a></td>
                                <td>
                                    <form action="/question/delete/{{$question->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


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
                                    <table id="iq">
                                        <label class="label-input100" for="message">Enter Question</label>
                                        <tr>
                                            <td>
                                                <div class="wrap-input100 validate-input">

                                                    <textarea id="message" cols="50" rows="5" name="question" placeholder="Please Enter Your Question" required></textarea>
                                                    <span class="focus-input100"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label-input100" for="answer">Answers*</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <textarea id="answer_0" cols="35" rows="2" type="text" name="answer_0" placeholder="Part Answer 1" required></textarea>
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

                                            </td>
                                        </tr>
                                    </table>
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




                <!--===============================================================================================-->
                <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/animsition/js/animsition.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/bootstrap/js/popper.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/select2/select2.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/daterangepicker/moment.min.js"></script>
                <script src="vendor/daterangepicker/daterangepicker.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/countdowntime/countdowntime.js"></script>
                <!--===============================================================================================-->
                <script src="js/main.js"></script>


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
                        let wrapper = $("#iq");
                        let i = 0;
                        $("#add-answer").click(function() {
                            i = i + 1;
                            $(wrapper).append(`
                            <div>
                              <tr>
                                <td>
                                  <div class="row" id="input-box">
                                    <div class="col-md-9">
                                      <div class="wrap-input100 rs validate-input">
                                        <textarea id="answer_${i}" type="text" name="answer_${i}" placeholder="Part Answer ${i+1}" cols="35" rows="2" class="answer" required></textarea>
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
                                      <input type="button" id="remove" class="btn btn-danger btn-sm remove_field" value="x">
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </div>
                            `);

                        });


                        $(".row").on("click", "#remove", function(e) {
                            console.log(this)
                            console.log(e.target);
                            $counter = i++;
                            $inputValue = $("#answer_" + $counter).val();

                            if (!$inputValue == "") {
                                $(".remove_field").attr("data-toggle", "modal").attr("data-target", "#staticBackdrop");
                                $("#staticBackdrop").on("click", ".btn-delete-input", function() {
                                    $(this).parent('div').remove();
                                    $("#staticBackdrop").modal('hide')
                                })
                            }else{

                                $(this).parent('div').remove();
                            }

                        });
                    });
                </script>
            </div>
        </div>
    </div>

</div>
@endsection