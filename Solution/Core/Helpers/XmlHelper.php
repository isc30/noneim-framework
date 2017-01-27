<?php

/**
 * Xml Helper
 * @package Core
 * @subpackage Helpers
 */
class XmlHelper {

    /**
     * No instantiable
     */
    private function __construct() {}

    /**
     * Convert SimpleXMLElement to Array
     * @param SimpleXMLElement $xml
     * @return array
     */
    public static function toArray(SimpleXMLElement $xml) {

        $array = array();

        foreach ($xml as $element) {

            /** @var SimpleXMLElement $element */

            $key = $element->getName();
            $value = get_object_vars($element);

            if (!empty($value)) {
                $array[$key] = $element instanceof SimpleXMLElement ? self::toArray($element) : (string)$value;
            } else {
                $array[$key] = trim($element);
            }

        }

        return $array;

    }

}