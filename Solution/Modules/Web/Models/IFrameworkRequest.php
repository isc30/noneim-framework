<?php

class IFrameworkRequest
{
    public $section;
    public $parameters;

    public function __construct()
    {
        $this->section = $this->getSection();
        $this->parameters = new IFrameworkRequestParameters($_GET, $_POST);
    }

    private function getSection()
    {
        if (isset($_GET[WebConfiguration::$sectionRequest]))
        {
            $section = $_GET[WebConfiguration::$sectionRequest];
            if ($section !== '')
            {
                return $section;
            }
        }

        return WebConfiguration::$defaultSection;
    }
}