<?php

namespace IWD\JOBINTERVIEW\Survey;

use IWD\JOBINTERVIEW\Survey\Model\Survey;
use IWD\JOBINTERVIEW\Survey\Model\SurveyMaker;

class SurveyDao
{
    /**
     * @var SurveyMaker
     */
    protected $survey_maker;
    /**
     * @var string
     */
    protected $data_location;

    /**
     * SurveyDao constructor.
     *
     * @param SurveyMaker $survey_maker
     * @param string $data_location
     */
    public function __construct(SurveyMaker $survey_maker, string $data_location)
    {
        $this->survey_maker = $survey_maker;
        $this->data_location = $data_location;
    }

    /**
     * Build surveys object from files.
     *
     * @return Survey[]
     * @throws \Exception
     */
    public function getSurveys() : array
    {
        $surveys = array();
        foreach ($this->fetchFiles() as $file) {
            $raw_survey = $this->fetchData($file);
            $surveys[] = $this->survey_maker->makeSurvey($raw_survey);
        }
        return $surveys;
    }

    /**
     * Read file and convert json into array.
     *
     * @param string $file
     * @return array
     * @throws \Exception
     */
    private function fetchData(string $file) : array
    {
        $file_path = $this->data_location.'/'.$file;
        if (!is_file($file_path)) {
            throw new \Exception('Unable to find data file.');
        }

        $json = file_get_contents($file_path);
        return json_decode($json, true);
    }

    /**
     * Get all file path in directory.
     *
     * @return string[]
     * @throws \Exception
     */
    private function fetchFiles() : array
    {
        if (!is_dir($this->data_location)) {
            throw new \Exception('Unable to find data directory.');
        }

        $files = array();
        foreach (scandir($this->data_location) as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $files[] = $file;
            }
        }

        return $files;
    }
}