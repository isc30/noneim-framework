<?php

class RouteDemoController extends BaseLayoutController
{
    /**
     * @return null|ActionResult
     */
    public function topics()
    {
        $forum = $this->getForum();

        $viewModel = new RouteDemoTopicsViewModel();
        $viewModel->topics = array();

        for ($i = 0, $end = count($forum); $i < $end; $i++)
        {
            $topic = $forum[$i];
            $topicViewModel = new TopicViewModel();
            $topicViewModel->title = $topic->title;
            $topicViewModel->description = $topic->description;
            $topicViewModel->subtopicsCount = count($topic->subtopics);
            $viewModel->topics[] = $topicViewModel;
        }

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Topics";
        $actionResult->content = new View('TopicList', $viewModel, __FILE__);

        return $this->baseLayout($actionResult);
    }


    /**
     * @param int $topicId
     * @return null|ActionResult
     */
    public function subTopics($topicId)
    {
        $forum = $this->getForum();

        if (isset($forum[$topicId]))
        {
            $topic = $forum[$topicId];

            $viewModel = new RouteDemoSubtopicsViewModel();
            $viewModel->topicId = $topicId;
            $viewModel->topicTitle = $topic->title;
            $viewModel->subtopics = array();

            for ($i = 0, $end = count($topic->subtopics); $i < $end; $i++)
            {
                $subtopic = $topic->subtopics[$i];
                $topicViewModel = new SubtopicViewModel();
                $topicViewModel->title = $subtopic->title;
                $topicViewModel->messagesCount = count($subtopic->messages);
                $viewModel->subtopics[] = $topicViewModel;
            }

            $actionResult = new BaseLayoutContentViewModel();
            $actionResult->title = "Subtopics";
            $actionResult->content = new View('SubtopicList', $viewModel, __FILE__);

            return $this->baseLayout($actionResult);
        }
        else
        {
            return new StringActionResult('Topic not found');
        }
    }

    /**
     * @param int $topicId
     * @param int $subtopicId
     * @param null|int $messageId
     * @return null|ActionResult
     */
    public function subTopicMessages($topicId, $subtopicId, $messageId = null)
    {
        $forum = $this->getForum();

        if (isset($forum[$topicId]))
        {
            $topic = $forum[$topicId];
            if (isset($topic->subtopics[$subtopicId]))
            {
                $subtopic = $topic->subtopics[$subtopicId];
                $viewModel = new RouteDemoMessagesViewModel();
                $viewModel->topicId = $topicId;
                $viewModel->topicTitle = $topic->title;
                $viewModel->subtopicId = $subtopicId;
                $viewModel->subtopicTitle = $subtopic->title;
                $viewModel->highlightedMessageId = $messageId !== null ? (int)$messageId : null;
                $viewModel->messages = array();

                for ($i = 0, $end = count($subtopic->messages); $i < $end; $i++)
                {
                    $message = $subtopic->messages[$i];
                    $messageViewModel = new MessageViewModel();
                    $messageViewModel->user = $message->user;
                    $messageViewModel->message = $message->message;
                    $viewModel->messages[] = $messageViewModel;
                }

                $actionResult = new BaseLayoutContentViewModel();
                $actionResult->title = "Messages";
                $actionResult->content = new View('MessageList', $viewModel, __FILE__);

                return $this->baseLayout($actionResult);
            }
            else
            {
                return new StringActionResult('Subtopic not found');
            }
        }
        else
        {
            return new StringActionResult('Topic not found');
        }
    }

    /**
     * @return Topic[]
     */
    private function getForum()
    {
        return array
        (
            new Topic('Programming', 'If you like programming, this is your Topic!', array
            (
                new Subtopic('C++ programming discussion', array
                (
                    new Message('Isc', 'Hi, I created this topic to discuss about the superiority of C++ over all languages.'),
                    new Message('John', 'I agree, but also Python is a good one.'),
                    new Message('MODERATOR', 'User <b>John</b> was banned 4 life.'),
                    new Message('Isc', 'This guy... python... hahahaha')
                )),
                new Subtopic('PYTHON IS WAY BETTER THAN OTHER LANGUAGEEESS', array
                (
                    new Message('NewUser1', 'PYTHON IS THE BEST LANGUAGE YOU\'LL EVER SEE!!!!!!'),
                    new Message('MODERATOR', 'User <b>NewUser1</b> was ip-banned.'),
                    new Message('MODERATOR', 'This guy... I banned his ip so he can\'t create new accounts'),
                    new Message('Isc', 'hahahaha')
                )),
            )),
            new Topic('Trains', 'Bigger or smaller, the trains are always amazing', array
            (
                new Subtopic('I recently bought a new small-sized train to play', array
                (
                    new Message('Andrew', 'Mine is 23cm long, red coloured. Share your trains, guys!'),
                    new Message('Andrew', 'No one?...'),
                    new Message('Andrew', ':\'('),
                )),
            )),
        );
    }
}