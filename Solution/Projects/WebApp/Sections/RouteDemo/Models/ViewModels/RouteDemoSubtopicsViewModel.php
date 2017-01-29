<?php

/**
 * Route Demo Subtopics ViewModel
 */
class RouteDemoSubtopicsViewModel implements IViewModel
{
    public $topicId;
    public $topicTitle;
    /** @var SubtopicViewModel[] */
    public $subtopics;
}