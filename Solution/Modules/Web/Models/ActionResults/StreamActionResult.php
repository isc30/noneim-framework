<?php

/**
 * Stream ActionResult
 */
class StreamActionResult extends ActionResult
{
    /** @var Generator */
    private $_generator;

    /**
     * StreamActionResult Constructor
     * @param Generator|Closure $generatorOrClosure
     */
    public function __construct($generatorOrClosure)
    {
        if ($generatorOrClosure instanceof Closure)
        {
            $this->_generator = ($generatorOrClosure());
        }
        else
        {
            $this->_generator = $generatorOrClosure;
        }
    }

    /**
     * Render content
     */
    public function render()
    {
        foreach ($this->_generator as $value)
        {
            if ($value instanceof ActionResult)
            {
                $value->render();
            }
            else
            {
                echo $value;
            }

            echo "\n";

            OutputBufferHelper::flush();
        }
    }
}