<?php

namespace IWD\JOBINTERVIEW\Survey\Model\Question;

abstract class QuestionAbstract implements QuestionInterface
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var mixed
     */
    protected $options;
    /**
     * @var mixed
     */
    protected $answer;

    /**
     * QuestionAbstract constructor.
     * @param string $type
     * @param string $label
     * @param mixed $options
     * @param mixed $answer
     */
    public function __construct(string $type, string $label, $options, $answer)
    {
        $this->type = $type;
        $this->label = $label;
        $this->options = $options;
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
}
