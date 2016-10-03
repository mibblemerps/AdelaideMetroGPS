<?php

namespace App\Gtfs;
use Illuminate\Database\Eloquent\Model;

/**
 * A Trip represents a journey taken by a vehicle through Stops. Trips are time-specific — they are defined as a
 * sequence of StopTimes, so a single Trip represents one journey along a transit line or route. In addition to
 * StopTimes, Trips use Calendars to define the days when a Trip is available to passengers.
 *
 * @property int $id Trip ID
 * @property int $route_id Route ID
 * @property int $service_id Uniquely identifies a set of dates when the service is available.
 * @property bool|null $outbound Is the trip outbound? True for outbound, false for inbound. Null if not used.
 * @property int|null $block_id ID of the block this trip belongs to. Null if doesn't belong to a block.
 * @property int|null $shape_id ID for the trip shape (shape is a set of coordinates showing the route a trip runs). Null if no data available.
 * @property string|null $headsign Text displayed on the headsign. Optional.
 * @property string|null $short_name The simple human-readable name for this route. Example: "502", or "GAWC". Required. If riders don't commonly use trip names, this can be null.
 * @property bool|null $wheelchair_accessible Can this trip accommodate a wheelchair? Null if unknown.
 * @property bool|null $bikes_allowed Can this trip accommodate bikes? Null if unknown.
 *
 * @package App\Gtfs
 */
class Trip extends Model
{
    public $timestamps = false;
}
