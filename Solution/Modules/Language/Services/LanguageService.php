<?php

/**
 * Language Service
 * @package Modules\Language
 * @subpackage Services
 */
class LanguageService implements ILanguageService
{
    /**
     * LanguageService Constructor
     */
    public function __construct()
    {
    }

    /**
     * Load $language
     * @param null|string $language Language to load
     * @return array
     */
    public function getLanguage($language = null)
    {
        if ($language === null)
        {
            $language = LanguageModuleConfiguration::defaultLanguage;
        }

        return $this->getFromXML($language);
    }

    /**
     * Load $language from XML
     * @param string $languageName
     * @return array
     */
    private function getFromXML($languageName)
    {
        $language = null;

        if (!CacheHelper::load('Modules/Language', "LanguageService.{$languageName}", $language))
        {
            $language = XmlHelper::toArray(simplexml_load_file(Configuration::rootDir . LanguageModuleConfiguration::languagesDirectory . "/{$languageName}.xml"));

            CacheHelper::save('Modules/Language', "LanguageService.{$languageName}", $language);
        }

        return $language;
    }
}