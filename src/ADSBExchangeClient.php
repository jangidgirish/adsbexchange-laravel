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

    public function hax(string|array $hex) : array
    {
        if(is_string($hex)){
            return $this->http->get("/hex/{$hex}")->json();
        }else{
            return $this->http->post('/hex', ['hex_list' => array_values($hex)])->json();
        }
    }

    public function search(array $params = [])
    {
        return $this->http->get("/search", $params)->json();
    }
}
