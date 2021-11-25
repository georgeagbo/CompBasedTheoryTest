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
                            <form class="contact100-form validate-form" action="/update/question/{{$currentQuestion->id}}" method="post">
                                @csrf
                                <span class="contact100-form-title">
                                    Update Questions
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

                                                    <textarea id="message" class="input100" name="question" placeholder="Please Enter Your Question" value="John" minlength="3" required>{{$currentQuestion->question}}</textarea>
                                                    <span class="focus-input100"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label-input100" for="answer">Answers*</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                $answers = $currentQuestion->answers;
                                                $json_answers = json_decode($answers);

                                                ?>
                                                @foreach($json_answers as $answer)
                                                <div class="row">
                                                    <div class="col-md-9">

                                                        <div class="wrap-input100 rs validate-input">

                                                            <textarea id="answer_0" cols="35" rows="2" type="text" name="answer_0" placeholder="Part Answer 1" value="John" minlength="3" required>{{$answer->answer}}</textarea>

                                                            <span class="focus-input100"></span>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="wrap-input100 rs validate-input">
                                                            <input style="width:100%; height:50px" type="number" step="0.01" name="mark_0" placeholder="{{$answer->mark}}" value="John" minlength="3" required>
                                                            <span class="focus-input100"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>

                                    <label class="label-input100" for="marks_obtainable" style="margin-top: 4%;">Marks obtainable</label>

                                    <div class="wrap-input100 validate-input">
                                        <input id="marks_obtainable" class="input100" type="number" name="marks_obtainable" placeholder="Marks Obtainable" value="John" minlength="3" required>
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                                <div class="container-contact100-form-btn">
                                    <button class="contact100-form-btn">
                                        <span>
                                            Update
                                            <i class="zmdi zmdi-arrow-right m-l-8"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let wrapper = $("#iq");
                        let i = 0;


                        $(".btn-delete-input").click(function() {

                            $("#input-box").parent('div').remove();
                            $('#staticBackdrop').modal('hide');
                        });
                    });
                </script>
            </div>
        </div>
    </div>

</div>
@endsection