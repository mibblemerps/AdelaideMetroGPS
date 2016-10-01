<?php

namespace App\Gtfs;

/**
 * GTFS Routes are equivalent to "Lines" in public transportation systems.
 * Routes are made up of one or more Trips — remember that a Trip occurs at a specific time and so a Route is time-independent.
 *
 * @package App\Gtfs
 */
class Route
{
    /**
     * @var int Unique route ID.
     */
    public $id;

    /**
     * @var int ID of the agency that handles this route.
     */
    public $agencyId;

    /**
     * @var string The simple human-readable name for this route. Example: "502", or "GAWC". Required.
     */
    public $shortName;

    /**
     * @var string This human-readable full name for this route. Example: "Salisbury Interchange to City"
     */
    public $fullName;

    /**
     * @var int Route type. All route types defined in the GTFS standard are in the RouteType class.
     */
    public $routeType;

    /**
     * @var string|null Description of this route. Example: "via Bridge Road and O-Bahn. Limited stop service. Operates 7 days." Optional.
     */
    public $description = null;

    /**
     * @var string|null URL to the route page. Optional.
     */
    public $routeUrl = null;

    /**
     * @var string Route colour in hexadecimal format. Default is white.
     */
    public $routeColour = 'FFFFFF';

    /**
     * @var string Route colour. Must be readable against the routeColour.
     */
    public $routeTextColour = '000000';
}
