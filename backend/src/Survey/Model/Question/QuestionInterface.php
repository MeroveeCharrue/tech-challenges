<?php

namespace IWD\JOBINTERVIEW\Survey\Model\Question;

interface QuestionInterface
{
    /**
     * @return string
     */
    public function getLabel() : string;

    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return mixed
     */
    public function getAnswer();

    /**
     * @return mixed
     */
    public function getOptions();
}