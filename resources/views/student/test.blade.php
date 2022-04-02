@extends('layouts.dashboard')
@section('content')

<div class="container-contact100" style="margin-top: 4%;">
    <div class="wrap-contact100">
        @if($questions->isEmpty())
        <h4 class="mb-3" style="text-align: center; font-size: 35px;">Test Not Ready!! <br><span class="text-primary mt-5" style="font-size: 20px;">Contact Admins</span></h4>
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
            <a id="submitExam" href="javascript::void[0]" style="font-size: 18px; margin-right: 50px;border-radius: 4px; padding: 4px 8px 4px 8px; color: #fff; background-color: #01131C;">Submit And Go!</a>

            <span class="contact100-form-title" style="position: relative; right: 0px;" id="timer">
                0 1 : 1 0
            </span>
            <span class="contact100-form-title">
                Lets GO!!
            </span>

            <label class="label-input100" for="message">Question No</label>
            <div class="wrap-input100 validate-input">
                <textarea id="question" class="input100" name="question" data="{{$questions}}"></textarea>
                <span class="focus-input100"></span>
            </div>

            <div style="margin-left: 30%;">
            </div>


            <label class="label-input100" for="email" style="margin-top: 4%;">Answer</label>
            <div class="wrap-input100 validate-input">
                <textarea id="answer" class="input100" name="answer" placeholder="Enter Your Answer Here"></textarea>
                <span class="focus-input100"></span>
            </div>
            <div id="question_answer"></div>
            <!-- <div class="container-contact100-form-btn">
                <button class="contact100-form-btn" id="submit">
                    <span>
                        Submit Answer
                        <i class="zmdi zmdi-arrow-right m-l-8"></i>
                    </span>
                </button>
            </div> -->
        </form>
        <div class="row col-md-6 m-auto text-center">
            <button class="bg-light text-primary p-2 mr-5" id="previous">Previous</button>
            <button class="bg-light text-primary p-2" id="next">Next</button>
        </div>

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
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('next').addEventListener('click', nextQuestion)
        document.getElementById('previous').addEventListener('click', previousQuestion)
        let question = document.getElementById('question');
        let answer = document.getElementById('answer')


        //let submit = document.getElementById('submit');

        let i = 0;
        var questionView = document.getElementById('question');
        var questions = document.getElementById('question').getAttribute('data');
        var questionArray = JSON.parse(questions)
        question.value = questionArray[0].question

        let data = [];

        function nextQuestion() {
            if (i < questionArray.length - 1) {
                i++;
                let answerValue = answer.value
                var addObject = {
                    question_id: questionArray[i].id,
                    answer: `${answerValue}`
                }

                showQuestionAndAnswer(questionArray[i], addObject);
                updateData(addObject);

            } else {
                submitExam(data);
            }

        }

        function previousQuestion() {

            if (i >= 1) {
                i--;
                //let lastIndex = data[i];
                objectIndex = data.findIndex(function(arr) {

                });

                addObject = {
                    id: i += 1,
                    question_id: questionArray[i].question_id,
                    answer: answer.value
                }
            }
        }

        function showQuestionAndAnswer(questionArray, obj) {
            question.value = questionArray.question;
            answer.value = obj.answer;
        }

        function updateData(obj) {
            data.push(obj)
            console.log(data)
        }
    });

    // var questionId = $("#question").data("id");
    // var answer = $("#answer").val();

    function submitExam(data) {
        $.ajax({
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "data": data,


            },
            url: "/store/answer",
            success: function(data) {
                window.location = '/test-submitted'

            }
        });
    }
</script>
<script src="{{asset ('/js/timer.js')}}"></script>

@endsection