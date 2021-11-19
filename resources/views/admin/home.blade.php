@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
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

                                                    <textarea id="message" class="input100" name="question" placeholder="Please Enter Your Question"></textarea>
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
                                                    <div class="col-md-7">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <input id="answer_0" class="input100" type="text" name="answer_0" placeholder="Part Answer 1">
                                                            <span class="focus-input100"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <input class="input100" type="number" step="0.01" name="mark_0" placeholder="E.g 0.5">
                                                            <span class="focus-input100"></span>
                                                        </div>
                                                    </div>

                                                </div>

                                            </td>
                                        </tr>
                                    </table>
                                    <input type="button" class="btn btn-sm" style="background: #d867c6;" id="add" value="Add more Answers">

                                    <label class="label-input100" for="marks_obtainable" style="margin-top: 4%;">Marks obtainable</label>

                                    <div class="wrap-input100 validate-input">
                                        <input id="marks_obtainable" class="input100" type="number" name="marks_obtainable" placeholder="Marks Obtainable">
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

                        $("#add").click(function() {
                            i = i + 1;
                            $(wrapper).append(`
                            <div>
                              <tr>
                                <td>
                                  <div class="row">
                                    <div class="col-md-7">
                                      <div class="wrap-input100 rs validate-input">
                                        <input id="answer_${i}" class="input100" type="text" name="answer_${i}" placeholder="Part Answer ${i+1}">
                                        <span class="focus-input100"></span>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="wrap-input100 rs validate-input">
                                        <input id="mark_${i}" class="input100" type="number" step="0.01" name="mark_${i}" placeholder="E.g 0.5">
                                        <span class="focus-input100"></span>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <input type="button" id="remove" class="btn btn-danger btn-sm remove_field" value="Remove">
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </div>
                            `);


                        });

                        $(wrapper).on("click", ".remove_field", function(e) {
                            e.preventDefault();
                            $(this).parent('div').parent('div').parent('div').remove();
                            i--;
                        });


                    });
                </script>
            </div>
        </div>
    </div>

</div>
@endsection