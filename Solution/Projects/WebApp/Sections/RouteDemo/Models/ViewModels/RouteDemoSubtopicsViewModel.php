<?php

/**
 * @package Application
 * @subpackage Models\ViewModels
 */
class RouteDemoSubtopicsViewModel implements IViewModel
{
    public $topicId;
    public $topicTitle;
    /** @var SubtopicViewModel[] */
    public $subtopics;
}