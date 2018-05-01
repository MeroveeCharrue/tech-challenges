<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionAbstract;

class QuestionQCM extends QuestionAbstract
{
    /**
     * @return string[]
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * @return bool[]
     */
    public function getAnswer() : array
    {
        return $this->answer;
    }
}