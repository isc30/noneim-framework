<?php

/**
 * Language Configuration
 */
class LanguageConfiguration extends DefaultLazyConfiguration
{
    /** @var string */
    public static $defaultLanguage = 'En';

    //////////////////////////////////////////
    // Automatic

    /** @var string */
    public static $languagesDir;

    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        self::$languagesDir = SolutionConfiguration::$projectDir . 'Languages/';
    }
}