<?php

/**
 * OutputBuffer Helper
 */
class OutputBufferHelper implements IHelper
{
    /**
     * Start capturing output to buffer
     * @param null|string $callback
     */
    public static function start($callback = null)
    {
        if ($callback === null)
        {
            ob_start();
        }
        else
        {
            ob_start($callback);
        }
    }

    /**
     * Return buffer content
     * @return string
     */
    public static function getContent()
    {
        return ob_get_contents();
    }

    /**
     * Print buffer content
     */
    public static function flush()
    {
        ob_flush();
        flush();
    }

    /**
     * Clean buffer content
     */
    public static function clean()
    {
        ob_clean();
    }

    /**
     * End buffering
     */
    public static function end()
    {
        ob_end_clean();
    }

    /**
     * Flush and End
     */
    public static function flushAndEnd()
    {
        self::flush();
        self::end();
    }
}