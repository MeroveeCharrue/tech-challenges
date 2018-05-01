<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionInterface;

class SurveyMaker
{
    /**
     * Build a complete survey from raw data.
     *
     * @param array $raw_data
     * @return Survey
     * @throws \Exception
     */
    public function makeSurvey($raw_data)
    {
        $survey = new Survey($raw_data['survey']['name'], $raw_data['survey']['code']);

        foreach ($raw_data['questions'] as $raw_question) {
            $question = $this->makeQuestion($raw_question);
            $survey->pushQuestion($question);
        }

        return $survey;
    }

    /**
     * Build and return a new question.
     *
     * @param $raw_question
     * @return QuestionInterface
     * @throws \Exception
     */
    protected function makeQuestion($raw_question) : QuestionInterface
    {
        switch ($raw_question['type']) {
            case 'qcm':
                $class = QuestionQCM::class;
                break;
            case 'numeric':
                $class = QuestionNumeric::class;
                break;
            case 'date':
                $class = QuestionDate::class;
                break;
            default:
                $class = null;
        }

        if (!$class) {
            throw new \Exception('Unrecognized question type.');
        }

        $question = new $class($raw_question['type'], $raw_question['label'], $raw_question['options'], $raw_question['answer']);

        return $question;
    }
}
