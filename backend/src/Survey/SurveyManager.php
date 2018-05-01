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
     * Get info for each unique survey code.
     *
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
     * Get answer aggregation by survey code.
     *
     * @param string $code
     * @return array
     * @throws \Exception
     */
    public function getAggregatedAnswers(string $code)
    {
        $surveys_array = $this->getAggregatedSurvey($code);

        $glob = array();

        $sum = 0;
        $date_list = array();
        $qcm = array();
        foreach ($surveys_array as $survey_array) {
            // Survey info
            $glob['code'] = $survey_array['code'];
            $glob['name'] = $survey_array['name'];

            $sum += $survey_array['questions']['numeric'];
            $date_list[] = $survey_array['questions']['date'];

            foreach ($survey_array['questions']['qcm'] as $option => $answer) {
                if (!isset($qcm[$option])) {
                    $qcm[$option] = 0;
                }
                if ($answer) {
                    $qcm[$option]++;
                }

            }
        }

        // Count surveys
        $nb_survey = count($surveys_array);
        $glob['survey_taken'] = $nb_survey;

        // Average products
        $avg = $sum / $nb_survey;
        $glob['average_number_of_products'] = intval($avg);

        // Date span
        sort($date_list);
        $glob['first_survey_date'] = reset($date_list)->format($this->date_format);
        $glob['last_survey_date'] = end($date_list)->format($this->date_format);

        // QCM
        $glob['best_sellers'] = $qcm;

        return $glob;
    }

    /**
     * Get aggregated survey
     *
     * @param string $code
     * @return array
     * @throws \Exception
     */
    private function getAggregatedSurvey(string $code) : array
    {
        $aggregation = array();
        foreach ($this->getSurveyByCode($code) as $survey) {
            $aggregation[] = $survey->getSurveyAsArray();
        }

        return $aggregation;
    }

    /**
     * Retrieve surveys by code.
     *
     * @param string $code
     * @return Survey[]
     * @throws \Exception
     */
    private function getSurveyByCode(string $code) : array
    {
        $surveys_by_code = array();
        foreach ($this->getAllSurvey() as $survey) {
            if ($survey->getCode() === $code) {
                $surveys_by_code[] = $survey;
            }
        }

        if (!$surveys_by_code) {
            throw new \Exception('There seems to be no survey by this code ('.$code.')');
        }

        return $surveys_by_code;
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
