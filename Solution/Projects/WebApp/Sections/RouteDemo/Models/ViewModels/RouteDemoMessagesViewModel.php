<?php

/**
 * Route Demo Messages ViewModel
 */
class RouteDemoMessagesViewModel implements IModel
{
    public $topicId;
    public $topicTitle;
    public $subtopicId;
    public $subtopicTitle;
    /** @var MessageViewModel[] */
    public $messages;
    public $highlightedMessageId;
}