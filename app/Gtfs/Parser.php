<?php

namespace App\Gtfs;

/**
 * GTFS feed parser.
 *
 * @package App\Gtfs
 */
class Parser
{
    /**
     * Parse a CSV file into an array.
     *
     * @param $filePath
     * @return array
     */
    public static function parseCsv($filePath)
    {
        $lines = explode("\n", str_replace("\r", '', file_get_contents($filePath))); // Read file

        $csv = [];

        // Parse header
        $header = explode(",", array_shift($lines));
        $columnCount = count($header);

        foreach ($lines as $line) {
            $columns = explode(',', $line);

            if (count($columns) != $columnCount) {
                // Miss matching column count. Discard this row.
                continue;
            }

            $csv[] = $columns;
        }

        return $csv;
    }
}
