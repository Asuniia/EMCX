<?php

namespace App\EMCX\src\license;

use App\EMCX\src\config\Configuration;
use App\EMCX\src\config\Request;
use App\EMCX\src\Exception\EMCXException;
use GuzzleHttp\Client;

class LicenseBuilder
{

    public array $data = [];
    protected array $server = [];
    protected Configuration $configuration;

    public function __construct(Client $client, Configuration $configuration, array $server)
    {
        $this->server = $server;
        $this->configuration = $configuration;

        $response = $client->get('/license/get', [
            'http_errors' => false,
            'query' => [
                'license' => $this->configuration->get()['key']
            ]
        ]);


        $this->data = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() == 422) {
            new EMCXException("Missing fields", "EMCX_REQUIRED_MISSING_FIELD");
        } elseif ($response->getStatusCode() == 401) {
            new EMCXException("This license is disabled", "EMCX_LICENSE_DISABLED");
        } elseif ($response->getStatusCode() == 200) {
            $this->setServerParams();
            return true;
        } else {
            new EMCXException($this->data['message'], $this->data['code']);
        }
        return false;
    }

    private function setServerParams()
    {
        if ($this->server['forceUpdate']) {
            if ($this->configuration->getConfig()['version'] != $this->server['version']) {
                die("EMCX Update... Please wait... VERSION:" . $this->server['version'] . " SERVER: " . $this->server['server']);
            }
        }
    }
}
