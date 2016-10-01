<?php

namespace App\Gtfs;

/**
 * Shapes describe the physical path that a vehicle takes, and are defined in the file shapes.txt.
 * Shapes belong to Trips, and consist of a sequence of points. Tracing the points in order provides the path of the vehicle.
 * The points do not need to match stop locations.
 *
 * @package App\Gtfs
 */
class Shape
{
    /**
     * @var int Unique identifier for the shape.
     */
    public $id;

    /**
     * @var ShapePoint[] Array of shape points, index being the sequence number (starting at 0).
     */
    public $points = [];
}
