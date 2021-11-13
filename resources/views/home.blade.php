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

                    {{ __('You are logged in!') }}
                </div>

                <div class="container-contact100">
                    <div class="wrap-contact100">
                        <form class="contact100-form validate-form">
                            <span class="contact100-form-title">
                                Upload Questions
                            </span>

                            <label class="label-input100" for="message">Enter Question</label>
                            <div class="wrap-input100 validate-input">
                                <textarea id="message" class="input100" name="question" placeholder="Please Enter Your Question"></textarea>
                                <span class="focus-input100"></span>
                            </div>


                            <label class="label-input100" for="first-name">Part Question*</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="wrap-input100 rs validate-input">
                                        <input id="first-name" class="input100" type="text" name="first-name" placeholder="Part Question">
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="wrap-input100 rs validate-input">
                                        <input class="input100" type="text" name="mark" placeholder="Marks">
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm">Add more Answers</button>

                            <label class="label-input100" for="email" style="margin-top: 4%;">Marks obtainable</label>
                            <div class="wrap-input100 validate-input">
                                <input id="email" class="input100" type="text" name="mark_obtainable" placeholder="Marks Obtainable">
                                <span class="focus-input100"></span>
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

            </div>
        </div>
    </div>

</div>
@endsection