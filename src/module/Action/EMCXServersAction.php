<?php

namespace App\EMCX\src\module\Action;

use App\EMCX\EMCXLoader;
use App\EMCX\src\config\Request;
use ClientX\Actions\Action;
use ClientX\Renderer\RendererInterface;
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
                'license' => $this->emcx->getConfig()['key']
            ]
        ]);

      /*  $obj = json_decode($response->getBody()->getContents(), true);
        foreach ($obj as $value) {
            $data = new Request($this->emcx->,$value['endpoint']);
            $value['endpoint'];
        }*/


        return $this->render('@emcx_admin/servers', [
            'selected_server' => $this->emcx->getConfig()['online_server']
        ]);
    }
}
