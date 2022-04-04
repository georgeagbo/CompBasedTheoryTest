@extends('layouts.dashboard')
@section('content')

<div class="container-contact100" style="margin-top: 4%;">
    <div class="wrap-contact100">
        @if($questions->isEmpty())
        <h4 class="mb-3" style="text-align: center; font-size: 35px;">Exam Questions Not Uploaded Yet!! <br><span class="text-primary mt-5" style="font-size: 20px;">Contact Admins For More Clarificaiton</span></h4>
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
        @if(empty(auth()->user()->result))
        <form class="contact100-form validate-form" id="form">
            @csrf
            <a id="submitExam" href="javascript::void[0]" style="font-size: 18px; margin-right: 50px;border-radius: 4px; padding: 4px 8px 4px 8px; color: #fff; background-color: #01131C;">Submit And Go!</a>

            <span class="contact100-form-title" style="position: relative; right: 0px;" id="timer">
                0 1 : 1 0
            </span>
            <span id="exam-duration" class="contact100-form-title" data-title="{{$examDuration}}">
               {{$title}}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('next').addEventListener('click', nextQuestion)
        document.getElementById('previous').addEventListener('click', previousQuestion)

        let questionView = document.getElementById('question');
        let answer = document.getElementById('answer')

        var questions = document.getElementById('question').getAttribute('data');
        var questionArray = JSON.parse(questions)
        questionView.value = questionArray[0].question

        let i = 0;
        let data = [];

        function nextQuestion() {
            if (i < questionArray.length - 1) {
                i++;
                if (data[i] != null) {
                    answer.value = data[i].answer;
                } else {
                    let answerValue = answer.value
                    if (questionArray[i].id != null) {
                        var dataObject = {
                            question_id: questionArray[i].id,
                            answer: `${answerValue}`
                        }
                    }
                }
                showQuestionAndAnswer(questionArray[i], dataObject);
                updateData(dataObject);

            }

        }

        function previousQuestion() {
            if (i >= 1) {
                i--;
                questionView.value = questionArray[i].question
                answer.value = data[i].answer

                let newAnswer = answer.value;
                data[i] = {
                    question_id: 100,
                    answer: `${newAnswer}`
                }
            }
        }

        function showQuestionAndAnswer(questionArray, obj) {
            questionView.value = questionArray.question;
            answer.value = obj.answer;
        }

        function updateData(obj) {
            data.push(obj)
            console.log(data)
            answer.value = null;
        }

        const submit = document.getElementById('submitExam');
        submit.addEventListener('click', function() {
            submitExam(data);
        });
    });

    function submitExam(data) {
        $.ajax({
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "data": data,
            },
            url: "/store/answer",
            success: function(data) {
                window.location.href = '/test-submitted'
                //console.log(data);

            }
        });
    }
</script>
<script src="{{asset ('/js/timer.js')}}"></script>

@endsection