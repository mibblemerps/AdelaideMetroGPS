<?php

namespace App\Gtfs;
use League\Csv\Reader;

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
     * @return \Iterator
     */
    public static function parseCsv($filePath)
    {
        $reader = Reader::createFromPath($filePath);
        return $reader->fetch();
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
            $stop->stop_code = self::strOrNull($row[1]);
            $stop->name = self::strOrNull($row[2]);
            $stop->description = self::strOrNull($row[3]);
            $stop->lat = self::doubleOrNull($row[4]);
            $stop->long = self::doubleOrNull($row[5]);
            $stop->zone_id = self::intOrNull($row[6]);
            $stop->stop_url = self::strOrNull($row[7]);
            $stop->is_station = ($row[8] == null) ? null : boolval($row[8]);
            $stop->parent_station = self::intOrNull($row[9]);
            $stop->timezone = $row[10];
            $stop->wheelchair_accessible = ($row[11] == null) ? null : boolval($row[11]);

            $stops[$stop->id] = $stop;
        }

        return $stops;
    }

    /**
     * Parse routes.txt
     *
     * @param array|string $csv Either pre-parsed CSV file or a path to a CSV file.
     * @return array Array of stops.
     */
    public static function parseRoutes($csv)
    {
        if (is_string($csv)) {
            $csv = self::parseCsv($csv);
        }

        $routes = [];
        foreach ($csv as $row) {
            $route = new Route();
            $route->id = strtoupper($row[0]);
            $route->agency_id = intval($row[1]);
            $route->short_name = $row[2];
            $route->full_name = $row[3];
            $route->description = $row[4];
            $route->route_type = intval($row[5]);
            $route->route_url = $row[6];
            $route->route_colour = $row[7];
            $route->route_text_colour = $row[8];

            $routes[$route->id] = $route;
        }

        return $routes;
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
            $trip->route_id = intval($row[0]);
            $trip->service_id = intval($row[1]);
            $trip->id = intval($row[2]);
            $trip->headsign = self::strOrNull($row[3]);
            $trip->short_name = self::strOrNull($row[4]);
            $trip->outbound = ($row[5] == null) ? null : boolval($row[5]);
            $trip->block_id = self::intOrNull($row[6]);
            $trip->shape_id = self::intOrNull($row[7]);
            $trip->wheelchair_accessible = ($row[8] == null) ? null : boolval($row[8]);

            $trips[$trip->id] = $trip;
        }

        return $trips;
    }

    /**
     * Parse shapes.txt
     *
     * @param $csv
     * @param callable $chunkCallback Callback called to process the shapes in chunks to prevent exhausting the memory.
     * @param int $chunkSize Size of chunks passed to $chunkCallback.
     * @return null
     */
    public static function parseShapes($csv, $chunkCallback, $chunkSize = 32)
    {
        if (is_string($csv)) {
            $csv = self::parseCsv($csv);
        }

        $i = 0;
        $shapePoints = [];
        foreach ($csv as $row) {
            $shapePoint = new Shape();
            $shapePoint->id = intval($row[0]);
            $shapePoint->sequence = intval($row[3]);
            $shapePoint->lat = doubleval($row[1]);
            $shapePoint->long = doubleval($row[2]);
            $shapePoint->distance = doubleval($row[4]);

            $shapePoints[] = $shapePoint;

            $i++;
            if ($i > $chunkSize) {
                // Run callback
                $chunkCallback($shapePoints);

                // Clear old shape points.
                $shapePoints = [];

                $i = 0;
            }
        }
    }
}
