<?php

namespace JangidGirish\ADSBExchange;

use Illuminate\Http\Client\PendingRequest;

class ADSBExchangeClient
{
    protected PendingRequest $http;

    public function __construct(PendingRequest $http)
    {
        $this->http = $http;
    }

    public function all(): array
    {
        return $this->getJson('/all');
    }

    public function totalAircraft(): array
    {
        return $this->getJson('/total-aircraft');
    }

    public function filter(array $request): array
    {
        return $this->postJson('/filter', $request);
    }

    public function hex(string|array $hex): array
    {
        if (is_string($hex)) {
            return $this->getJson('/hex/' . $this->commaSeparated($hex));
        }

        return $this->postJson('/hex', ['hex_list' => $this->stringList($hex)]);
    }

    public function hax(string|array $hex): array
    {
        return $this->hex($hex);
    }

    public function icao(string|array $icao): array
    {
        if (is_string($icao)) {
            return $this->getJson('/icao/' . $this->commaSeparated($icao));
        }

        return $this->postJson('/icao', ['hex_list' => $this->stringList($icao)]);
    }

    public function military(): array
    {
        return $this->getJson('/mil');
    }

    public function mil(): array
    {
        return $this->military();
    }

    public function callsign(string|array $callsign): array
    {
        return $this->getJson('/callsign/' . $this->commaSeparated($callsign));
    }

    public function registration(string|array $registration): array
    {
        if (is_string($registration)) {
            return $this->getJson('/registration/' . $this->commaSeparated($registration));
        }

        return $this->postJson('/registration', ['registrations' => $this->stringList($registration)]);
    }

    public function squawk(string|array $squawk): array
    {
        return $this->getJson('/sqk/' . $this->commaSeparated($squawk));
    }

    public function latLonDistance(float|int|string $lat, float|int|string $lon, float|int|string $dist): array
    {
        return $this->getJson(sprintf('/lat/%s/lon/%s/dist/%s', $lat, $lon, $dist));
    }

    public function proximityRadius(array $filters): array
    {
        return $this->postJson('/proximity/radius', ['filters' => $filters]);
    }

    public function minimalLatLonDistance(float|int|string $lat, float|int|string $lon, float|int|string $dist): array
    {
        return $this->getJson(sprintf('/minimal/lat/%s/lon/%s/dist/%s', $lat, $lon, $dist));
    }

    public function noHexDistanceAbove(
        float|int|string $dist,
        float|int|string $alt,
        float|int|string $lat,
        float|int|string $lon
    ): array {
        return $this->getJson(sprintf('/nohex/dist/%s/above/%s/lat/%s/lon/%s', $dist, $alt, $lat, $lon));
    }

    public function airport(string|array $airport): array
    {
        if (is_string($airport)) {
            return $this->getJson('/airport/' . $this->commaSeparated($airport));
        }

        return $this->postJson('/airport', ['airports' => $this->stringList($airport)]);
    }

    public function geospatialBoundary(array $featureCollection): array
    {
        return $this->postJson('/geospatial/boundary', $featureCollection);
    }

    public function geospatialCountry(string $country): array
    {
        return $this->getJson('/geospatial/country/' . rawurlencode($country));
    }

    public function geospatialCountrySubdivisions(string $country): array
    {
        return $this->getJson('/geospatial/country/' . rawurlencode($country) . '/subdivisions');
    }

    public function geospatialCountrySubdivision(string $country, string $subdivision): array
    {
        return $this->getJson(
            '/geospatial/country/' . rawurlencode($country) . '/subdivision/' . rawurlencode($subdivision)
        );
    }

    public function geospatialRegion(string $region): array
    {
        return $this->getJson('/geospatial/region/' . rawurlencode($region));
    }

    public function geospatialContinent(string $continent): array
    {
        return $this->getJson('/geospatial/continent/' . rawurlencode($continent));
    }

    public function operationsIcaos(string|array $icao): array
    {
        if (is_string($icao)) {
            return $this->getJson('/operations/icao/' . $this->commaSeparated($icao));
        }

        return $this->postJson('/operations/icaos', ['icaos' => $this->stringList($icao)]);
    }

    public function operationsIcao(string $icao): array
    {
        return $this->getJson('/operations/icao/' . rawurlencode($icao));
    }

    public function operationsAirports(string|array $airport): array
    {
        if (is_string($airport)) {
            return $this->getJson('/operations/airport/' . $this->commaSeparated($airport));
        }

        return $this->postJson('/operations/airports', ['airports' => $this->stringList($airport)]);
    }

    public function operationsAirport(string $airport): array
    {
        return $this->getJson('/operations/airport/' . rawurlencode($airport));
    }

    public function traces(string $folder, string $jsonFile): array
    {
        return $this->getJson('/traces/' . rawurlencode($folder) . '/' . rawurlencode($jsonFile));
    }

    public function tracesHist(int|string $year, int|string $month, int|string $day, string $folder, string $jsonFile): array
    {
        return $this->getJson(sprintf(
            '/traces-hist/%s/%s/%s/traces/%s/%s',
            $year,
            $month,
            $day,
            rawurlencode($folder),
            rawurlencode($jsonFile)
        ));
    }

    /**
     * Legacy helper retained for backwards compatibility.
     */
    public function search(array $params = []): array
    {
        return $this->getJson('/search', $params);
    }

    protected function getJson(string $url, array $query = []): array
    {
        return $this->http->get($url, $query)->throw()->json();
    }

    protected function postJson(string $url, array $payload): array
    {
        return $this->http->post($url, $payload)->throw()->json();
    }

    protected function commaSeparated(string|array $value): string
    {
        if (is_string($value)) {
            return rawurlencode($value);
        }

        return rawurlencode(implode(',', $this->stringList($value)));
    }

    protected function stringList(array $items): array
    {
        return array_values(array_map(static fn ($item) => (string) $item, $items));
    }
}
