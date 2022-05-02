<?php

namespace App\EMCX\src\config;

use App\EMCX\src\Exception\EMCXException;
use GuzzleHttp\Client;

class Request
{

    const ENDPOINT_API = 'https://emcx.aktech.fr';
    const ENDPOINT_DEV_API = 'http://192.168.1.88:3333';

    public Configuration $configuration;
    public Client $client;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        if ($this->configuration->get()['dev']) {
            return $this->client = new Client(['base_uri' => self::ENDPOINT_DEV_API]);
        } else {
            if (!str_contains($_SERVER['HTTPS'], 'On')) {
                new EMCXException("WARNING: No SSL! Please use SSL! Security risk!", "EMCX_SSL_MISSING");
            }
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
