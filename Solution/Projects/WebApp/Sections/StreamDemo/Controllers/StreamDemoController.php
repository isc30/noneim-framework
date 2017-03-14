<?php

/**
 * Stream Demo Controller
 */
class StreamDemoController extends BaseLayoutController
{
    /**
     * Default Action
     * @return null|ActionResult
     */
    public function index()
    {
        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Stream Demo";
        $actionResult->content = new View('Index', null, __FILE__);

        return $this->baseLayout($actionResult);
    }

    /**
     * @return ActionResult|null
     */
    public function fancyTask()
    {
        $generator = $this->progressGenerator();

        return new StreamActionResult($generator);
    }

    /**
     * @return ActionResult|null
     */
    public function sendEmails()
    {
        return new StreamActionResult(function()
        {
            yield "Email sent to ivan@example.com";
            sleep(1); // WOW much work

            yield "Email sent to juan@example.com";
            sleep(1);

            // Also ActionResults can be yielded
            yield new JsonActionResult(array
            (
                'success' => false,
                'message' => 'Sending to pepe@example.com FAILED'
            ));
            sleep(1);

            yield "Email sent to marcheton@example.com";
        });
    }

    private function progressGenerator()
    {
        // Trying to make the % a bit unstable
        for ($i = 0; $i < 100; $i += rand(1, 3))
        {
            usleep(rand(10000, 250000)); // Hard work :D

            yield $i + 1;
        }

        yield 100;
    }
}