<?php

namespace App\EMCX\src\module\Action;

use App\EMCX\EMCXLoader;
use ClientX\Actions\Action;
use Psr\Http\Message\ResponseInterface;

class EMCXModuleAction extends Action
{

    protected EMCXLoader $emcx;

    public function __construct(EMCXLoader $emcx)
    {
        $this->emcx = $emcx;
    }

    public function __invoke(): ResponseInterface
    {

        return $this->json($this->emcx->modules->getModulesPublic());
    }
}
