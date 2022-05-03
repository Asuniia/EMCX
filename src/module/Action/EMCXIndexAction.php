<?php

namespace App\EMCX\src\module\Action;

use App\ClientX\Cache\LicenseCache;
use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use ClientX\Renderer\RendererInterface;
use ClientX\Session\FlashService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\ServerRequestInterface;

class EMCXIndexAction extends Action
{
    protected EMCXLoader $emcx;
    protected array $server = [];
    protected array $modules = [];

    /**
     * @param RendererInterface
     */
    public function __construct(EMCXLoader $emcx, RendererInterface $renderer, FlashService $flash)
    {
        $this->emcx = $emcx;
        $this->renderer   = $renderer;
        $this->flash = $flash;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $this->server = $this->emcx->getRequest()->getServerEndpoint()[0];

        try {
            $data = (new Client())->get($this->server['endpoint'] . '/emcx/repository', [
                'http_errors' => false,
                'timeout' => 0.0001
            ]);

            $this->modules = json_decode($data->getBody()->getContents(), true);
        } catch (ConnectException $exception) {
            $this->error("EMCX Server is down.");
        }

        return $this->render('@emcx_admin/index', [
            'selected_server' => $this->emcx->getConfig()->get()['online_server'],
            'modules' => $this->modules,
        ]);
    }
}
