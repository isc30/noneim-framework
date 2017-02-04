<?php

/**
 * Url Helper
 */
class UrlHelper extends StaticClass
{
    /**
     * Return full link of section
     * @param string[] $sections
     * @return string
     */
    public static function getLink(array $sections)
    {
        if (WebConfiguration::$prettyUrl)
        {
            return WebConfiguration::$webUrl . self::getSectionName($sections);
        }
        else
        {
            return WebConfiguration::$webUrl . '?' . WebConfiguration::$sectionRequest . '=' . self::getSectionName($sections);
        }
    }

    /**
     * Return full section name
     * @param string[] $sections
     * @return string
     */
    public static function getSectionName(array $sections)
    {
        return implode(WebConfiguration::$subsectionSeparator, $sections);
    }

    /**
     * Return section array
     * @param string $sectionName
     * @return string[]
     */
    public static function getSectionArray($sectionName)
    {
        return explode(WebConfiguration::$subsectionSeparator, $sectionName);
    }
}