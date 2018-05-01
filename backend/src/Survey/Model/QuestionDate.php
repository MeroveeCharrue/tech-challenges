<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionAbstract;

class QuestionDate extends QuestionAbstract
{
    /**
     * @return \DateTime
     */
    public function getAnswer() : \DateTime
    {
        return new \DateTime($this->answer);
    }
}