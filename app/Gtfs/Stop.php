<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 1/10/2016
 * Time: 2:53 PM
 */

namespace App\Gtfs;

/**
 * A stop is a location where vehicles stop to pick up or drop off passengers.
 * Stops can be grouped together, such as when there are multiple stops within a single station.
 * This is done by defining one Stop for the station, and defining it as a parent for all the Stops it contains.
 * Stops may also have zone identifiers, to group them together into zones. This can be used together with
 * FareAttributes and FareRules for zone-based ticketing.
 *
 * @package App\Gtfs
 */
class Stop
{
    /**
     * @var int Stop ID
     */
    public $id;

    /**
     * @var string A human-readable name for the stop.
     */
    public $name;

    /**
     * @var string|null Stop code. Usually a short number or text representing the stop. Often used to lookup timetables for the stop. Optional.
     */
    public $stopCode = null;

    /**
     * @var double Stop latitude.
     */
    public $lat;

    /**
     * @var double Stop longitude.
     */
    public $long;

    /**
     * @var string|null Description of stop. Optional.
     */
    public $description;

    /**
     * @var int ID for this zone. Zones are used for fare zones.
     */
    public $zoneId;

    /**
     * @var string URL to a webpage about this stop.
     */
    public $stopUrl;

    /**
     * @var bool|null Is this stop a station? Null if unknown.
     */
    public $isStation = null;

    /**
     * @var int|null ID of the parent station for this stop.
     */
    public $parentStation = null;

    /**
     * @var string|null Timezone this stop is located in. This should be a TZ-format timezone, see: https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
     */
    public $stopTimezone = null;

    /**
     * @var bool|null Can this stop accommodate a wheelchair? Null if unknown.
     */
    public $wheelchairAccessible = null;
}
