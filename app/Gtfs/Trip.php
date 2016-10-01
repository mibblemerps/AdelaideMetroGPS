<?php

namespace App\Gtfs;

/**
 * A Trip represents a journey taken by a vehicle through Stops. Trips are time-specific — they are defined as a
 * sequence of StopTimes, so a single Trip represents one journey along a transit line or route. In addition to
 * StopTimes, Trips use Calendars to define the days when a Trip is available to passengers.
 *
 * @package App\Gtfs
 */
class Trip
{
    /**
     * @var int Trip ID.
     */
    public $id;

    /**
     * @var int Unique route identifier.
     */
    public $routeId;

    /**
     * @var int Uniquely identifies a set of dates when the service is available.
     */
    public $serviceId;

    /**
     * @var bool|null Is the trip outbound? True for outbound, false for inbound. Null if not used.
     */
    public $outbound = null;

    /**
     * @var int|null ID of the block this trip belongs to. Null if doesn't belong to a block.
     */
    public $blockId = null;

    /**
     * @var int|null ID for the trip shape (shape is a set of coordinates showing the route a trip runs). Null if no data available.
     */
    public $shapeId = null;

    /**
     * @var string|null Text displayed on the headsign. Optional.
     */
    public $headsign = null;

    /**
     * @var string|null The simple human-readable name for this route. Example: "502", or "GAWC". Required. If riders don't commonly use trip names, this can be null.
     */
    public $shortName = null;

    /**
     * @var bool|null Can this trip accommodate a wheelchair? Null if unknown.
     */
    public $wheelchairAccessible = null;

    /**
     * @var bool|null Can this trip accommodate bikes? Null if unknown.
     */
    public $bikesAllowed = null;
}
