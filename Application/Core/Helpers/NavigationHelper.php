<?php

/**
 * Navigation Helper
 * @package Core
 * @subpackage Helpers
 */
class NavigationHelper implements IHelper {

    /**
     * No instanciable
     */
    private function __construct() {}

    /**
     * Return full link of section
     * @param string[] $sections
     * @return string
     */
    public static function getLink(array $sections) {

        if (Configuration::prettyUrl) {
            return Configuration::webUrl . self::getSectionName($sections);
        } else {
            return Configuration::webUrl . '?' . Configuration::sectionRequest . '=' . self::getSectionName($sections);
        }

    }

    /**
     * Return full section name
     * @param string[] $sections
     * @return string
     */
    public static function getSectionName(array $sections) {

        return implode(Configuration::subsectionSeparator, $sections);

    }

    /**
     * Return section array
     * @param string $sectionName
     * @return string[]
     */
    public static function getSectionArray($sectionName) {

        return explode(Configuration::subsectionSeparator, $sectionName);

    }

}