<?php

namespace JangidGirish\ADSBExchange\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * @method static array all()
 * @method static array totalAircraft()
 * @method static array filter(array $request)
 * @method static array hex(string|array $hex)
 * @method static array hax(string|array $hex)
 * @method static array icao(string|array $icao)
 * @method static array military()
 * @method static array mil()
 * @method static array callsign(string|array $callsign)
 * @method static array registration(string|array $registration)
 * @method static array squawk(string|array $squawk)
 * @method static array latLonDistance(float|int|string $lat, float|int|string $lon, float|int|string $dist)
 * @method static array proximityRadius(array $filters)
 * @method static array minimalLatLonDistance(float|int|string $lat, float|int|string $lon, float|int|string $dist)
 * @method static array noHexDistanceAbove(float|int|string $dist, float|int|string $alt, float|int|string $lat, float|int|string $lon)
 * @method static array airport(string|array $airport)
 * @method static array geospatialBoundary(array $featureCollection)
 * @method static array geospatialCountry(string $country)
 * @method static array geospatialCountrySubdivisions(string $country)
 * @method static array geospatialCountrySubdivision(string $country, string $subdivision)
 * @method static array geospatialRegion(string $region)
 * @method static array geospatialContinent(string $continent)
 * @method static array operationsIcaos(string|array $icao)
 * @method static array operationsIcao(string $icao)
 * @method static array operationsAirports(string|array $airport)
 * @method static array operationsAirport(string $airport)
 * @method static array traces(string $folder, string $jsonFile)
 * @method static array tracesHist(int|string $year, int|string $month, int|string $day, string $folder, string $jsonFile)
 * @method static array search(array $params = [])
 */
class ADSBExchange extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'adsbexchange.client';
    }
}
