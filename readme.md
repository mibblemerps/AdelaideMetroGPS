# Adelaide Metro Bus Tracker

See where any Adelaide Metro bus is on a map in real-time.

### How it works
Since Adelaide Metro don't release vehicle GPS positions via their
[SIRI API](http://user47094.vs.easily.co.uk/siri/index.htm), but do update the estimated time of arrival for a vehicle
to a stop, we can approximate how far the vehicle is between two stops and pinpoint it on a map.

It gets static information such as routes from the Adelaide Metro [GTFS feed](http://data.sa.gov.au/data/dataset/adelaide-metro-general-transit-feed).
The real-time information is retrieved from the SIRI feed. Theoretically, this could be adapted to other transit networks.

### Resources
 * [Adelaide Metro Google Group](https://groups.google.com/forum/#!forum/adelaide-metro-developer-group) (must request access)
 * [SIRI Documentation](http://user47094.vs.easily.co.uk/siri/index.htm) (it's pretty bad)
 * [GTFS Documentation](https://developers.google.com/transit/gtfs/reference/) (quite good)
