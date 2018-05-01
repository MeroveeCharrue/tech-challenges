<?php

namespace IWD\JOBINTERVIEW\Survey\Model;

use IWD\JOBINTERVIEW\Survey\Model\Question\QuestionAbstract;

class QuestionQCM extends QuestionAbstract
{
    /**
     * @return array
     */
    public function getAnswer() : array
    {
        return array_combine($this->options, $this->answer);
    }
}
