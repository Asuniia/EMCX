<?php

namespace App\EMCX\src\module\Action;

use ClientX\Actions\Action;
use ClientX\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class EMCXIndexAction extends Action
{
    /**
     * @param RendererInterface
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer   = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return $this->render('@emcx_admin/index');
    }
}