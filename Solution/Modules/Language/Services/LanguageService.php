<?php

/**
 * Language Service
 * @package Modules\Language
 * @subpackage Services
 */
class LanguageService implements ILanguageService
{
    /** ICacheService */
    private $_cacheService;

    /**
     * LanguageService Constructor
     * @param ICacheService $cacheService
     */
    public function __construct(ICacheService $cacheService)
    {
        $this->_cacheService = $cacheService;
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
        if (!$this->_cacheService->load('Modules/Language', "LanguageService_{$languageName}", $language))
        {
            $language = XmlHelper::toArray(simplexml_load_file(Configuration::rootDir . LanguageModuleConfiguration::languagesDirectory . "/{$languageName}.xml"));
            $this->_cacheService->save('Modules/Language', "LanguageService_{$languageName}", $language);
        }

        return $language;
    }
}