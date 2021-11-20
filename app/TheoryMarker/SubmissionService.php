<?php

namespace App\TheoryMarker;

use App\Models\Question;

class SubmissionService
{
    public function markQuestion(int $questionId, string $answer)
    {
        //get question
        $question = Question::find($questionId);
        $answers = $question->answers;
        $marksObtained = 0;

        foreach ($answers as $partAnswer) {

            $partAnswerOptions = explode(';', $partAnswer->answer);

            foreach ($partAnswerOptions as $option) {
                if (stristr($answer, $option)) {
                    $marksObtained += $partAnswer->mark;
                    break;
                }
            }
        }

        $marksObtained = $marksObtained > $question->marks_obtainable ? $question->marks_obtainable : $marksObtained;
        return $marksObtained;
    }
}
