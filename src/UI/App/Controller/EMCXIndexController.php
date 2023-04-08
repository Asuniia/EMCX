<?php

namespace App\EMCX\src\UI\App\Controller;

use ClientX\Actions\Action;
use ClientX\Renderer\RendererInterface;
use ClientX\Session\FlashService;

class EMCXIndexController extends Action
{

    /**
     * @param RendererInterface
     */
    public function __construct(RendererInterface $renderer, FlashService $flash)
    {
        $this->renderer   = $renderer;
        $this->flash = $flash;
    }

    public function __invoke()
    {
        return $this->render('@emcx/app/pages/overview');
    }
}