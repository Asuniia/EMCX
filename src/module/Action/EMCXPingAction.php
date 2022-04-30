<?php

namespace App\EMCX\src\module\Action;

use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class EMCXPingAction extends Action
{
    protected EMCXLoader $emcx;
    protected ContainerInterface $container;

    public function __construct(EMCXLoader $emcx, ContainerInterface $container)
    {
        $this->emcx = $emcx;
        $this->container = $container;
    }

    public function __invoke(): ResponseInterface
    {

        return $this->json(
            [
                "emcx_version" => $this->emcx->getConfig()->get()['version'],
                "clientx_version" => (int)$this->container->get('app.version'),
                "modules" => count($this->emcx->modules->getModulesPublic())
            ]
        );
    }
}
