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
     * Returns the string unless it's empty, in which case it returns null.
     *
     * @param string $str Input string.
     * @return string|null
     */
    public static function strOrNull($str)
    {
        return ($str == '') ? null : $str;
    }

    /**
     * Returns the integer (if string it is converted), unless it's empty, in which case it returns null.
     *
     * @param $int
     * @return int|null
     */
    public static function intOrNull($int)
    {
        return ($int == '') ? null : intval($int);
    }

    /**
     * Returns the double (if string it is converted), unless it's empty, in which case it returns null.
     *
     * @param $double
     * @return double|null
     */
    public static function doubleOrNull($double)
    {
        return ($double == '') ? null : doubleval($double);
    }

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

    /**
     * Parse stops.txt
     *
     * @param array|string $csv Either pre-parsed CSV file or a path to a CSV file.
     * @return array Array of stops.
     */
    public static function parseStops($csv)
    {
        if (is_string($csv)) {
            $csv = self::parseCsv($csv);
        }

        $stops = [];
        foreach ($csv as $row) {
            $stop = new Stop();
            $stop->id = intval($row[0]);
            $stop->stopCode = self::strOrNull($row[1]);
            $stop->name = self::strOrNull($row[2]);
            $stop->description = self::strOrNull($row[3]);
            $stop->lat = self::doubleOrNull($row[4]);
            $stop->long = self::doubleOrNull($row[5]);
            $stop->zoneId = self::intOrNull($row[6]);
            $stop->stopUrl = self::strOrNull($row[7]);
            $stop->isStation = ($row[8] == null) ? null : boolval($row[8]);
            $stop->parentStation = self::intOrNull($row[9]);
            $stop->stopTimezone = $row[10];
            $stop->wheelchairAccessible = ($row[11] == null) ? null : boolval($row[11]);

            $stops[$stop->id] = $stop;
        }

        return $stops;
    }

    /**
     * Parse trips.txt
     *
     * @param array|string $csv Either pre-parsed CSV file or a path to a CSV file.
     * @return array Array of trips.
     */
    public static function parseTrips($csv)
    {
        if (is_string($csv)) {
            $csv = self::parseCsv($csv);
        }

        $trips = [];
        foreach ($csv as $row)
        {
            $trip = new Trip();
            $trip->routeId = intval($row[0]);
            $trip->serviceId = intval($row[1]);
            $trip->id = intval($row[2]);
            $trip->headsign = self::strOrNull($row[3]);
            $trip->shortName = self::strOrNull($row[4]);
            $trip->outbound = ($row[5] == null) ? null : boolval($row[5]);
            $trip->blockId = self::intOrNull($row[6]);
            $trip->shapeId = self::intOrNull($row[7]);
            $trip->wheelchairAccessible = ($row[8] == null) ? null : boolval($row[8]);

            $trips[$trip->id] = $trip;
        }

        return $trips;
    }
}
