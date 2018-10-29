<?php

namespace H4MSK1\Filter;

use Michelf\MarkdownExtra;

/**
 * Filter and format text content.
 */
class TextFilter
{
    /**
     * @var array $filters Supported filters with method names of 
     *                     their respective handler.
     */
    private $filters = [
        "bbcode"    => "bbcode2html",
        "markdown"  => "markdown",
        "link"      => "makeClickable",
        "nl2br"     => "nl2br",
        "esc"       => "doEscape",
        "strip"     => "doStripTags",
    ];

    public function getFiltersName()
    {
        return array_keys($this->filters);
    }

    /**
     * Call each filter on the text and return the processed text.
     *
     * @param string $text   The text to filter.
     * @param array|string  $filter Array of filters to use.
     *
     * @return string with the formatted text.
     */
    public function parse($text, $filter = [])
    {
        if (! $filter) {
            $filter = ["nl2br"];
        }

        if (! is_array($filter)) {
            $filter = explode(",", $filter);
        }

        if (! in_array("link", $filter)) {
            // always make links clickable
            array_push($filter, "link");
        }

        foreach ($filter as $type) {
            $text = $this->runFilter($text, $type);
        }

        return $text;
    }

    private function runFilter($text, $filter)
    {
        $filter = trim($filter);

        if (! array_key_exists($filter, $this->filters)) {
            throw new \Exception("Unkown type filter: $filter");
        }

        $method = $this->filters[$filter];
        return $this->$method($text);
    }

    public function doEscape($text)
    {
        return htmlentities($text, ENT_QUOTES, "UTF-8");
    }

    public function doStripTags($text)
    {
        return strip_tags($text);
    }

    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string $text The text to be converted.
     *
     * @return string the formatted text.
     */
    public function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\"{$matches[0]}\">{$matches[0]}</a>";
            },
            $text
        );
    }



    /**
     * Format text according to Markdown syntax.
     * @SuppressWarnings(PHPMD)
     * @param string $text The text that should be formatted.
     *
     * @return string as the formatted html text.
     */
    public function markdown($text)
    {
        return MarkdownExtra::defaultTransform($text);
    }



    /**
     * For convenience access to nl2br formatting of text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }
}
