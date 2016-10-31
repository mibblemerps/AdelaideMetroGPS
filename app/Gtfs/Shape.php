<?php

namespace App\Gtfs;
use Illuminate\Database\Eloquent\Model;

/**
 * Shapes describe the physical path that a vehicle takes, and are defined in the file shapes.txt.
 * Shapes belong to Trips, and consist of a sequence of points. Tracing the points in order provides the path of the vehicle.
 * The points do not need to match stop locations.
 *
 * @property int $id Index of this shape point.
 * @property int $shape_id Shape ID
 * @property int $sequence Number of this point in the sequence for this shape.
 * @property double $lat Latitude
 * @property double $long Longitude
 * @property double $distance Distance travelled since last point.
 *
 * @package App\Gtfs
 */
class Shape extends Model
{
    public $timestamps = false;
}
