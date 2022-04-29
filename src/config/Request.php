<?php

namespace App\EMCX\src\config;

use GuzzleHttp\Client;

class Request
{

    const ENDPOINT_API = 'https://emcx.aktech.fr';
    const ENDPOINT_DEV_API = 'http://127.0.0.1:3333';

    public Configuration $configuration;
    public Client $client;

    public function __construct(Configuration $configuration, ?string $endpoint)
    {
        $this->configuration = $configuration;

        if ($endpoint) {
            return $this->client = new Client(['base_uri' => $endpoint]);
        } elseif ($this->configuration->getConfig()['dev']) {
            return $this->client = new Client(['base_uri' => self::ENDPOINT_DEV_API]);
        } else {
            return $this->client = new Client(['base_uri' => self::ENDPOINT_API]);
        }
    }

    public function getServerData()
    {
        $response = $this->client->get('/', [
            'http_errors' => false,
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
