<?php

namespace App\Covid;

use GuzzleHttp\Client;

class CovidApi
{
    const URL_BRASIL_IO = 'https://brasil.io/api/dataset/covid19/caso/data/?format=json';

    const URL_BRAZIL_COVID19 = 'https://covid19-brazil-api.now.sh/api/report/v1';

    const URL_COVID19_API = 'https://api.covid19api.com/summary';

    public function __construct()
    {
        $this->client = new Client;
    }

    public function getCaseForStates()
    {
        $response = $this->client->get(static::URL_BRAZIL_COVID19);

        return json_decode($response->getBody()->getContents(), true)['data'];
    }

    public function getCaseContirmedAndDeath()
    {
        $response = $this->client->get(static::URL_BRASIL_IO);

        return json_decode($response->getBody()->getContents(), true)['results'];
    }

    public function getTotalCaseContirmedAndDeathWorld()
    {
        $response = $this->client->get(static::URL_COVID19_API);

        return json_decode($response->getBody()->getContents(), true)['Global'];
    }

}
