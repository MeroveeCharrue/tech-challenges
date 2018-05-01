<?php

namespace IWD\JOBINTERVIEW\Survey;

use IWD\JOBINTERVIEW\Survey\Model\Survey;

class SurveyManager
{
    /**
     * @var SurveyDao
     */
    protected $survey_dao;
    /**
     * @var string
     */
    protected $date_format;

    /**
     * SurveyManager constructor.
     *
     * @param SurveyDao $survey_dao
     * @param string $date_format
     */
    public function __construct(SurveyDao $survey_dao, string $date_format)
    {
        $this->survey_dao = $survey_dao;
        $this->date_format = $date_format;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getUniqueCodes()
    {
        $response = array();
        $exists = array();
        foreach ($this->getAllSurvey() as $survey) {
            if (!in_array($survey->getCode(), $exists)) {
                $exists[] = $survey->getCode();
                $response[] = $survey->getInfo();
            }
        }
        return $response;
    }

    /**
     * Retrieve all surveys.
     *
     * @return Survey[]
     * @throws \Exception
     */
    private function getAllSurvey() : array
    {
        return $this->survey_dao->getSurveys();
    }
}