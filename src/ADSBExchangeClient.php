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

    public function aircraft(string $hex)
    {
        return $this->http->get("/aircraft/{$hex}")->json();
    }

    public function positions(string $hex, array $params = [])
    {
        return $this->http->get("/aircraft/{$hex}/positions", $params)->json();
    }

    public function search(array $params = [])
    {
        return $this->http->get("/search", $params)->json();
    }
}
