<?php

namespace App\Gtfs;
use Illuminate\Database\Eloquent\Model;

/**
 * GTFS Routes are equivalent to "Lines" in public transportation systems.
 * Routes are made up of one or more Trips — remember that a Trip occurs at a specific time and so a Route is time-independent.
 *
 * @property string $id Unique route ID. Can be string.
 * @property int $agency_id ID of the agency that handles this route.
 * @property string $short_name The simple human-readable name for this route. Example: "502", or "GAWC". Required.
 * @property string $full_name This human-readable full name for this route. Example: "Salisbury Interchange to City"
 * @property int $route_type Route type. All route types defined in the GTFS standard are in the RouteType class.
 * @property string|null $description Description of this route. Example: "via Bridge Road and O-Bahn. Limited stop service. Operates 7 days." Optional.
 * @property string|null $route_url URL to the route page. Optional.
 * @property string $route_colour Route colour in hexadecimal format. Default is white.
 * @property string $route_text_colour Route colour. Must be readable against the routeColour. Default is black.
 *
 *
 * @package App\Gtfs
 */
class Route extends Model 
{
    public $timestamps = false;

    public $incrementing = false; // This allows non-numerical indexes.
}
