<?php

namespace App\EMCX\modules\module\Exemple;

use ClientX\Module;
use ClientX\Renderer\RendererInterface;

class EMCXExempleModule extends Module
{
    const DEFINITIONS = "";

    public function __construct(RendererInterface $renderer)
    {
        die('Powered by EMCX!');
    }
}