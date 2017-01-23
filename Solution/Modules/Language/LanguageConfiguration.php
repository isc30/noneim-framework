<?php

/**
 * Language Module Configuration
 * @package Modules\Language
 */
class LanguageConfiguration implements IDefaultLazyConfiguration
{
    public static $defaultLanguage = 'En';
    public static $languagesPath;

    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        self::$languagesPath = SolutionConfiguration::$projectPath . 'Languages/';
    }
}