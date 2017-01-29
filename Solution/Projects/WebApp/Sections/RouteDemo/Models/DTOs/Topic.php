<?php

class Topic
{
    public $title;
    public $description;
    /** @var Subtopic[] */
    public $subtopics;

    public function __construct($title = null, $description = null, $subtopics = array())
    {
        $this->title = $title;
        $this->description = $description;
        $this->subtopics = $subtopics;
    }
}