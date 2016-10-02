<?php

namespace App\Siri;

class SiriVisit
{
    /**
     * @var string Identifier for this stop.
     */
    public $stopCode;

    /**
     * @var object Timestamp that this data was recorded by the transport authority.
     */
    public $recordedAt;

    /**
     * @var bool|null Is the trip outbound? True for outbound, false for inbound. Null if not used.
     */
    public $outbound = null;

    /**
     * @var string Driver identifier.
     */
    public $driverReference = null;

    /**
     * @var string Vehicle identification code.
     */
    public $vehicleReference = null;

    /**
     * @var string Line name, eg. "502", "J1" or "GAWC".
     */
    public $lineRef;

    /**
     * @var bool Is this trip being monitored?
     */
    public $monitored = false;

    /**
     * @var object Timestamp the transport will most likely reach the stop. Updated via GPS.
     */
    public $estimatedArrivalTime;
}
