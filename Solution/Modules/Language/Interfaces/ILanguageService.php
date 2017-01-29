<?php

interface ILanguageService extends IService
{
    /**
     * Load $language
     * @param null|string $language Language to load
     * @return array
     */
    public function getLanguage($language = null);
}