<?php

namespace App\Gtfs;
use Illuminate\Database\Eloquent\Model;

/**
 * A stop is a location where vehicles stop to pick up or drop off passengers.
 * Stops can be grouped together, such as when there are multiple stops within a single station.
 * This is done by defining one Stop for the station, and defining it as a parent for all the Stops it contains.
 * Stops may also have zone identifiers, to group them together into zones. This can be used together with
 * FareAttributes and FareRules for zone-based ticketing.
 *
 * @property int $id Stop ID
 * @property string $name A human-readable name for the stop.
 * @property string|null $stop_code Stop code. Usually a short number or text representing the stop. Often used to lookup timetables for the stop. Optional.
 * @property double $lat Stop latitude.
 * @property double $long Stop longitude.
 * @property string|null $description Description of stop. Optional.
 * @property int $zone_id ID for this zone. Zones are used for fare zones.
 * @property string $stop_url URL to a webpage about this stop.
 * @property bool|null $is_station Is this stop a station? Null if unknown.
 * @property int|null $parent_station ID of the parent station for this stop.
 * @property string|null $timezone Timezone this stop is located in. This should be a TZ-format timezone, see: https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
 * @property bool|null $wheelchair_accessible Can this stop accommodate a wheelchair? Null if unknown.
 *
 * @package App\Gtfs
 */
class Stop extends Model
{
    public $timezones = false;
}
