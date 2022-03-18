@extends('layouts.dashboard')
@section('content')

<div class="container-contact100" style="margin-top: 4%;">
    <div class="wrap-contact100">
        @if($questions->isEmpty())
        <h4 class="mb-3" style="text-align: center; font-size: 35px;">Test Not Ready!! <br><span class="text-primary mt-5" style="font-size: 20px;">Check back in 1hr time</span></h4>
        <div class="container-contact100-form-btn mt-5">
            <a href="/home">
                <button class="contact100-form-btn">
                    <span>
                        Dismiss
                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                    </span>
                </button>
            </a>
        </div>
        @else
        @if(auth()->user()->test_status == '0')
        <form class="contact100-form validate-form" id="form">
            @csrf
            <a id="submitExam" class="bg-gray-100 dark:bg-gray-900" href="javascript::void[0]" style="font-size: 18px; margin-right: 50px;border-radius: 4px; padding: 4px 8px 4px 8px; color: #fff;">Submit And Go!</a>

            <span class="contact100-form-title" style="position: relative; right: 0px;" id="timer">
                0 1 : 1 0
            </span>
            <span class="contact100-form-title">
                Lets GO!!
            </span>
            @foreach($questions as $question)
            <label class="label-input100" for="message">Question No: {{$currentPage}}</label>
            <div class="wrap-input100 validate-input">
                <textarea id="question" class="input100" name="question" data-id="{{$question->id}}">{{$question->question}}</textarea>
                <span class="focus-input100"></span>
            </div>
            @endforeach
            <div style="margin-left: 30%;">
                {{ $questions->links() }}
            </div>


            <label class="label-input100" for="email" style="margin-top: 4%;">Answer</label>
            <div class="wrap-input100 validate-input">
                <textarea id="answer" class="input100" name="answer" placeholder="Enter Your Answer Here"></textarea>
                <span class="focus-input100"></span>
            </div>
            <div id="question_answer"></div>
            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn" id="submit">
                    <span>
                        Submit Answer
                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                    </span>
                </button>
            </div>
        </form>
        @else
        <h1 style="margin-left:10%; color: red; margin-bottom: 30px;">You have taken your test!!</h1>
        <div class="container-contact100-form-btn">
            <a href="/students/{{auth()->user()->id}}/result">
                <button class="contact100-form-btn">
                    <span>
                        Check Result
                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                    </span>
                </button>
            </a>
        </div>
        @endif
        @endif
    </div>
</div>
<script src="{{asset ('/js/timer.js')}}"></script>
<script>
    $(document).ready(function() {
        $("#submit").click(function(e) {
            event.preventDefault();
            var questionId = $("#question").data("id");
            var answer = $("#answer").val();

            $.ajax({
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "questionId": questionId,
                    "answer": answer

                },
                url: "/store/answer",
                success: function(data) {
                    $("#question_answer").html(data.mark + "/" + data.total)
                    //window.location.href = data;
                }
            });
        });

    });
</script>
<script src="{{asset ('/js/timer.js')}}"></script>

@endsection