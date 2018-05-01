<?php

namespace IWD\JOBINTERVIEW\Survey;

class SurveyAPI
{
    /**
     * @var SurveyDao
     */
    protected $surveyManager;

    /**
     * SurveyAPI constructor.
     *
     * @param SurveyManager $surveyManager
     */
    public function __construct(SurveyManager $surveyManager)
    {
        $this->surveyManager = $surveyManager;
    }

    /**
     * @route "/survey/list"
     *
     * @return array
     * @throws \Exception
     */
    public function getSurveyList() : array
    {
        return $this->surveyManager->getUniqueCodes();
    }
}