<?php

namespace App\EMCX\src\module\Action;

use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use ClientX\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EMCXModuleAction extends Action
{

    protected EMCXLoader $emcx;

    public function __construct(EMCXLoader $emcx, Router $router)
    {
        $this->emcx = $emcx;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'POST') {
            $name = $request->getAttribute('name');
            $state = !$this->emcx->modules->getModules()[$name]['enabled'];
            $this->emcx->getConfig()->setItem($name, 'enabled', $state);
            return $this->redirectToRoute('admin.emcx.index');
        }

        return $this->json($this->emcx->modules->getModulesPublic());
    }
}
