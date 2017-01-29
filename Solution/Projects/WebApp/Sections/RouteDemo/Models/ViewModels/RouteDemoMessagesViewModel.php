<?php

class RouteDemoMessagesViewModel implements IViewModel
{
    public $topicId;
    public $topicTitle;
    public $subtopicId;
    public $subtopicTitle;
    /** @var MessageViewModel[] */
    public $messages;
    public $highlightedMessageId;
}