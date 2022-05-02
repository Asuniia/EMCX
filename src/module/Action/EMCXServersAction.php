<?php

namespace App\EMCX\src\module\Action;

use App\ClientX\Cache\LicenseCache;
use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use ClientX\Renderer\RendererInterface;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\ServerRequestInterface;

class EMCXServersAction extends Action
{
    protected EMCXLoader $emcx;
    protected array $endpoints = [];

    /**
     * @param RendererInterface
     */
    public function __construct(EMCXLoader $emcx, RendererInterface $renderer)
    {
        $this->emcx = $emcx;
        $this->renderer   = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $response = $this->emcx->getRequest()->getClient()->get('/repositories/all', [
            'http_errors' => false,
            'query' => [
                'license' => $this->emcx->getConfig()->get()['key'],
                'domain' => (new LicenseCache())->getLicense()->get('domain')
            ]
        ]);

        $obj = json_decode($response->getBody()->getContents(), true);

        foreach ($obj as $value) {
            try {
                $data = (new \GuzzleHttp\Client())->get($value['endpoint'] . '/emcx/ping', [
                    'http_errors' => false,
                    'timeout' => 0.0001
                ]);


                $this->endpoints = json_decode($data->getBody()->getContents(), true);
            } catch (ConnectException $exception) {
                continue;
            }
        }

        return $this->render('@emcx_admin/servers', [
            'selected_server' => $this->emcx->getConfig()->get()['online_server'],
            'servers' => $this->endpoints
        ]);
    }
}
