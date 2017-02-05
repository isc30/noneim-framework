<?php

/**
 * Route Demo Subtopics ViewModel
 */
class RouteDemoSubtopicsViewModel implements IModel
{
    public $topicId;
    public $topicTitle;
    /** @var SubtopicViewModel[] */
    public $subtopics;
}