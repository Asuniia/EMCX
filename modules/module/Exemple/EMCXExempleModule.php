<?php

namespace App\EMCX\modules\module\Exemple;

use ClientX\Module;
use ClientX\Renderer\RendererInterface;

class EMCXExempleModule extends Module
{

    public function __construct()
    {
        echo "<h1 class='text-danger'>Powered by EMCX!</h1>";
    }
}