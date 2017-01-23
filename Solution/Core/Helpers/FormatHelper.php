<?php

/**
 * Format Helper
 * @package Core
 * @subpackage Helpers
 */
class FormatHelper implements IHelper
{
    /**
     * No instantiable
     */
    private function __construct()
    {
    }

    /**
     * Return the input string with the first letter uppercased
     * @param string $string
     * @return string
     */
    public static function firstUppercase($string)
    {
        if (strlen($string) > 0)
        {
            $string[0] = strtoupper($string[0]);
        }

        return $string;
    }

    /**
     * Clean the string for correct output
     * @param string $string
     * @return string
     */
    public static function cleanOutput($string)
    {
        $string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
        $string = htmlentities($string, ENT_QUOTES, 'UTF-8');

        return $string;
    }

    /**
     * Clean the array elements for correct output
     * @param string[] &$values Value array
     */
    public static function cleanOutputArray(array &$values)
    {
        foreach ($values as &$value)
        {
            if (!is_array($value))
            {
                $value = self::cleanOutput($value);
            }
            else
            {
                self::cleanOutputArray($value);
            }
        }
    }

    public static function minimizeHtml($buffer)
    {
        if (!ValidationHelper::isHtml($buffer))
        {
            return $buffer;
        }

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->loadHTML($buffer);

        $xpath = new DOMXPath($doc);

        // Remove comments
        foreach ($xpath->query('//comment()') as $comment)
        {
            $comment->parentNode->removeChild($comment);
        }

        // Remove extra whitespaces
        $skip = array('pre', 'code', 'script', 'textarea');
        foreach ($xpath->query('//text()') as $node)
        {
            if (!in_array($node->parentNode->nodeName, $skip))
            {
                $node->nodeValue = preg_replace('/[\n\s\r]{2,}/', ' ', $node->nodeValue);
                if ($node->nodeValue === ' ')
                {
                    $node->nodeValue = null;
                }
            }
        }

        $doc->normalizeDocument();
        $html = $doc->saveHTML();

        return trim($html);
    }
}