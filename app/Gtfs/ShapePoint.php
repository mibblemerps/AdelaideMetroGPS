<?php

namespace App\Gtfs;

/**
 * Represents a single step in a route shape.
 *
 * @package App\Gtfs
 */
class ShapePoint
{
    /**
     * @var int Number of this point in the sequence for this shape.
     */
    public $sequence;

    /**
     * @var double Latitude
     */
    public $lat;

    /**
     * @var double Longitude
     */
    public $long;

    /**
     * @var double Distance traveled since last point.
     */
    public $distance = 0;


    public function __construct($sequence, $lat, $long, $distance = 0)
    {
        $this->sequence = $sequence;
        $this->lat = $lat;
        $this->long = $long;
        $this->distance = $distance;
    }
}