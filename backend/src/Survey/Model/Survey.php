<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionInterface;

class Survey
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $code;
    /**
     * @var QuestionInterface[]
     */
    protected $question_list;

    /**
     * Survey constructor.
     *
     * @param String $name
     * @param String $code
     */
    public function __construct(String $name, String $code)
    {
        $this->name = $name;
        $this->code = $code;
        $this->question_list = array();
    }

    /**
     * @param QuestionInterface $question
     */
    public function pushQuestion(QuestionInterface $question)
    {
        $this->question_list[] = $question;
    }

    /**
     * @return string[]
     */
    public function getInfo() : array
    {
        return array(
            "name" => $this->name,
            "code" => $this->code
        );
    }

    /**
     * @return string
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAggregatedQuestions() : array
    {
        $aggregation = array();
        foreach ($this->question_list as $question) {
            switch ($question->getType()) {
                case 'qcm':
                    $aggregation['qcm'] = array_combine(
                        $question->getOptions(),
                        $question->getAnswer()
                    );
                    break;
                case 'numeric':
                    $aggregation['numeric'] = $question->getAnswer();
                    break;
                case 'date':
                    $aggregation['date'] = $question->getAnswer();
                    break;
                default:
                    $class = null;
            }
        }
        return $aggregation;
    }
}