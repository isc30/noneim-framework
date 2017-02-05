<?php

/**
 * Html Helper
 */
class HtmlHelper extends StaticClass
{
    /**
     * Anti-XSS
     * @param string $input
     * @return string
     */
    public static function escape($input)
    {
        $string = mb_convert_encoding($input, 'UTF-8', 'UTF-8');
        $string = htmlentities($string, ENT_QUOTES, 'UTF-8');

        return $string;
    }

    /**
     * Anti-XSS for string array
     * @param string[] $inputs
     * @return string[]
     */
    public static function escapeArray(array $inputs)
    {
        foreach ($inputs as &$input)
        {
            if (is_array($input))
            {
                $input = self::escapeArray($input);
            }
            else
            {
                $input = self::escape($input);
            }
        }

        return $inputs;
    }

    /**
     * Test if $buffer is HTML
     * @param string $buffer
     * @return bool
     */
    public static function isHtml($buffer)
    {
        return substr(trim($buffer), 0, 2) === '<!';
    }

    /**
     * Minimize HTML
     * @param string $buffer
     * @return string
     */
    public static function minimizeHtml($buffer)
    {
        if (!self::isHtml($buffer))
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