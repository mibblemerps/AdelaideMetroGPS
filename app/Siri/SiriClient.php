<?php

namespace App\Siri;

/**
 * SIRI API client.
 *
 * @package App\Siri
 */
class SiriClient
{
    protected $endpoint;

    /**
     * SiriClient constructor.
     *
     * @param string $endpoint URL where the API can be accessed. Example: "http://realtime.adelaidemetro.com.au/SiriWebServiceSAVM"
     */
    public function __construct($endpoint = 'http://realtime.adelaidemetro.com.au/SiriWebServiceSAVM')
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Parse a Siri style JSON date. The timestamp is converted from millisecond format to seconds format automatically.
     * Example: "/Date(1475390107000+1030)/", will return 1475390107.
     *
     * @param string $dateStr Date string
     * @param object $default What to return if failed to parse date string. Defaults to null.
     * @return int|object Timestamp (or $default if no date string couldn't be parsed).
     */
    protected function parseSiriDate($dateStr, $default = null)
    {
        $matches = [];
        if (!preg_match('/\/Date\(([0-9]+)\+[0-9]+\)\//', $dateStr, $matches) == 1) {
            return $default; // no date recognised
        }
        return intval(round($matches[1] / 1000)); // (divide by 1000 to convert milliseconds to seconds)
    }

    /**
     * Get realtime data for a stop.
     * Gets all the Siri visits to the stop and returns them in an array.
     *
     * @param string $stopCode
     * @return SiriVisit[]
     */
    public function getRealtimeData($stopCode)
    {
        // Send request
        $rawResp = file_get_contents($this->endpoint . '/SiriStopMonitoring.svc/json/SM?MonitoringRef=' . urlencode($stopCode));
        $json = json_decode($rawResp, true);

        $visits = [];

        foreach ($json['StopMonitoringDelivery'][0]['MonitoredStopVisit'] as $visitJson) {
            $visit = new SiriVisit();
            $visit->stopCode = $visitJson['MonitoredVehicleJourney']['MonitoredCall']['StopPointRef']['Value'];
            $visit->recordedAt = $this->parseSiriDate($visitJson['RecordedAtTime']);
            $visit->outbound = ($visitJson['MonitoredVehicleJourney']['DirectionRef']['Value'] == 'O');
            $visit->driverReference = isset($visitJson['MonitoredVehicleJourney']['DriverRef']) ? $visitJson['MonitoredVehicleJourney']['DriverRef'] : null;
            $visit->vehicleReference = isset($visitJson['MonitoredVehicleJourney']['VehicleRef']) ? $visitJson['MonitoredVehicleJourney']['VehicleRef']['Value'] : null;
            $visit->lineRef = $visitJson['MonitoredVehicleJourney']['LineRef']['Value'];
            $visit->monitored = $visitJson['MonitoredVehicleJourney']['Monitored'];
            $visit->estimatedArrivalTime = $this->parseSiriDate($visitJson['MonitoredVehicleJourney']['MonitoredCall']['AimedArrivalTime']);

            $visits[] = $visit;
        }

        return $visits;
    }
}
