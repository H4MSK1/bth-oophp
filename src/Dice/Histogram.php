<?php

namespace H4MSK1\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    public $serie = [];
    public $min;
    public $max;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $series = array_count_values($this->getSerie());

        for ($i = $this->min; $i < $this->max; $i++) {
            if (! array_key_exists($i, $series)) {
                $series[$i] = 0;
            }
        }

        ksort($series);

        $html = "<ul style=\"list-style: none;\">";

        foreach ($series as $key => $value) {
            $asterisk = str_repeat("*", $value);
            $html .= "<li>{$key}: {$asterisk}</li>";
        }

        return $html . "</ul>";
    }

    public function getAsSimpleText()
    {
        $series = array_count_values($this->getSerie());

        for ($i = $this->min; $i < $this->max; $i++) {
            if (! array_key_exists($i, $series)) {
                $series[$i] = 0;
            }
        }

        ksort($series);

        $text = null;

        foreach ($series as $key => $value) {
            $asterisk = str_repeat("*", $value);
            $text .= "{$key}: {$asterisk}\n";
        }

        return $text;
    }

    public function getAsArray()
    {
        $series = array_count_values($this->getSerie());

        for ($i = $this->min; $i < $this->max; $i++) {
            if (! array_key_exists($i, $series)) {
                $series[$i] = 0;
            }
        }

        ksort($series);

        $array = [];

        foreach ($series as $key => $value) {
            $asterisk = str_repeat("*", $value);
            $array[$key] = $asterisk;
        }

        return $array;
    }

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }
}
