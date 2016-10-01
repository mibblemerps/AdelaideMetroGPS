<?php

namespace App\Gtfs;

/**
 * Defines the different types of public transport defined by the GTFS standard.
 *
 * @package App\Gtfs
 */
class RouteType
{
    /**
     * Tram, Streetcar, Light rail. Any light rail or street level system within a metropolitan area.
     */
    const ROUTE_TYPE_TRAM = 0;

    /**
     * Subway, Metro. Any underground rail system within a metropolitan area.
     */
    const ROUTE_TYPE_SUBWAY = 1;

    /**
     * Rail. Used for intercity or long-distance travel.
     */
    const ROUTE_TYPE_RAIL = 2;

    /**
     * Bus. Used for short- and long-distance bus routes.
     */
    const ROUTE_TYPE_BUS = 3;

    /**
     * Ferry. Used for short- and long-distance boat service.
     */
    const ROUTE_TYPE_FERRY = 4;

    /**
     * Cable car. Used for street-level cable cars where the cable runs beneath the car.
     */
    const ROUTE_TYPE_CABLE_CAR = 5;

    /**
     * Gondola, Suspended cable car. Typically used for aerial cable cars where the car is suspended from the cable.
     */
    const ROUTE_TYPE_GONDOLA = 6;

    /**
     * Funicular. Any rail system designed for steep inclines.
     */
    const ROUTE_TYPE_FUNICULAR = 7;

}