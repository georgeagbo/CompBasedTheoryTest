<?php

namespace App\TheoryMarker;

use App\Models\Question;

class SubmissionService
{
    public function markQuestion(int $questionId, string $answer): array
    {
        //get question
        $question = Question::find($questionId);
        $answers = json_decode($question->answers);
        $marksObtained = 0;

        foreach ($answers as $partAnswer) {

            $partAnswerOptions = explode(';', $partAnswer->answer);

            foreach ($partAnswerOptions as $option) {
                if (stristr($answer, trim($option))) {
                    $marksObtained += $partAnswer->mark;
                    break;
                }
            }
        }

        $marksObtained = $marksObtained > $question->marks_obtainable ? $question->marks_obtainable : $marksObtained;
        return ['mark' => $marksObtained, 'total' => $question->marks_obtainable];
    }

}