<?php

namespace App\EMCX\src\module\Action;

use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use ClientX\Router;
use ClientX\Session\FlashService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EMCXServerJoinAction extends Action
{
    protected EMCXLoader $emcx;
    protected ContainerInterface $container;
    protected FlashService $flash;

    public function __construct(EMCXLoader $emcx, ContainerInterface $container, FlashService $flash, Router $router)
    {
        $this->emcx = $emcx;
        $this->container = $container;
        $this->flash = $flash;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $name = $request->getAttribute('name');
        $this->emcx->getConfig()->setConfig('online_server', $name);
        return $this->redirectToRoute($this->generateURL('admin.emcx.servers'));
    }
}
