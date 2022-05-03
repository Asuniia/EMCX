<?php

namespace App\EMCX\src\license;

use App\ClientX\Cache\LicenseCache;
use App\EMCX\src\config\Configuration;
use App\EMCX\src\config\Request;
use App\EMCX\src\Exception\EMCXException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class LicenseBuilder
{

    public array $data = [];
    protected array $server = [];
    protected Configuration $configuration;

    public function __construct(Client $client, Configuration $configuration, array $server)
    {
        $this->server = $server;
        $this->configuration = $configuration;

        try {
            $response = $client->get('/license/get', [
                'http_errors' => false,
                'timeout' => 2,
                'query' => [
                    'license' => $this->configuration->get()['key'],
                    'domain' => (new LicenseCache())->getLicense()->get('domain')
                ]
            ]);
        } catch (ConnectException $exception) {
            return new EMCXException("API is down", "EMCX_API_NETWORK_DOWN");
        }

        $this->data = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() == 422) {
            new EMCXException("Missing fields", "EMCX_REQUIRED_MISSING_FIELD");
        } elseif ($response->getStatusCode() == 401) {
            new EMCXException("This license is disabled", "EMCX_LICENSE_DISABLED");
        } elseif ($response->getStatusCode() == 200) {
            $this->setServerParams();
            return $this->data;
        } else {
            new EMCXException($this->data['message'], $this->data['code']);
        }
        return false;
    }

    private function setServerParams()
    {
        if ($this->server['forceUpdate']) {
            if ($this->configuration->get()['version'] != $this->server['version']) {
                die("EMCX Update... Please wait... VERSION:" . $this->server['version'] . " SERVER: " . $this->server['server']);
            }
        }
    }
}
