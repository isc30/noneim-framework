<?php

/**
 * Redirect ActionResult
 * @package Core
 * @subpackage Models\ActionResults
 */
class RedirectActionResult extends ActionResult
{
    /** @var string|string[] */
    public $urlOrSection;

    /** @var int */
    public $waitSeconds;

    /**
     * RedirectActionResult Constructor
     * @param string|string[] $urlOrSection
     * @param int $waitSeconds
     */
    public function __construct($urlOrSection, $waitSeconds = 0)
    {
        $this->urlOrSection = $urlOrSection;
        $this->waitSeconds = $waitSeconds;
    }

    /**
     * Is url a section
     * @return bool
     */
    public function isSection()
    {
        return is_array($this->urlOrSection);
    }

    /**
     * Render content
     */
    public function render()
    {
        // Nothing, it's a redirection LOL
    }
}