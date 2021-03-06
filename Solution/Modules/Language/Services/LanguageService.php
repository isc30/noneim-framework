<?php

/**
 * Language Service
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
            $language = LanguageConfiguration::$defaultLanguage;
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

        if (!CacheHelper::load('Modules/Language', 'LanguageService', $language, $languageName))
        {
            $language = XmlHelper::toArray(simplexml_load_file(SolutionConfiguration::$projectDir . LanguageConfiguration::$languagesDirectory . "/{$languageName}.xml"));

            CacheHelper::save('Modules/Language', 'LanguageService', $language, $languageName);
        }

        return $language;
    }
}