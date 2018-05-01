<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionAbstract;

class QuestionNumeric extends QuestionAbstract
{
    /**
     * @return int
     */
    public function getAnswer() : int
    {
        return intval($this->answer);
    }
}
