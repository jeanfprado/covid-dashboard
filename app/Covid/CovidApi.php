<?php

namespace App\Covid;

use GuzzleHttp\Client;

class CovidApi
{
    /**
     * APIs
     */
    const URL_BRASIL_IO = 'https://brasil.io/api/v1/dataset/covid19/caso/data/';

    const URL_BRAZIL_COVID19 = 'https://covid19-brazil-api.now.sh/api/report/v1';

    const URL_COVID19_API = 'https://api.covid19api.com/summary';

    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * Get cases for states
     *
     * @return array
     */
    public function getCaseForStates()
    {
        $response = $this->client->get(static::URL_BRAZIL_COVID19);

        return json_decode($response->getBody()->getContents(), true)['data'];
    }

    /**
     * Get Cases Contirmed and death all brazil
     *
     * @return void
     */
    public function getCaseContirmedAndDeath()
    {
        $data = [];

        $page = 1;

        do {
            $response = $this->client->get(static::URL_BRASIL_IO, [
                'query' => [
                    'format' => 'json',
                    'is_last' => 'True',
                    'page' => $page
                ]
            ]);

            $contents = json_decode($response->getBody()->getContents(), true);

            $data[] = $contents['results'];

            //We sleep so that API does not overload request
            sleep(32);

            $page++;
        } while ($page < 4);

        return $data;
    }

    /**
     * Get total case covid 19 in world
     *
     * @return array
     */
    public function getTotalCaseContirmedAndDeathWorld()
    {
        $response = $this->client->get(static::URL_COVID19_API);

        return json_decode($response->getBody()->getContents(), true)['Global'];
    }
}
