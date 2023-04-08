<?php

namespace App\EMCX\modules\Exemple;
use ClientX\Module;
use ClientX\Router;

class EMCXExempleModule extends Module
{
    public function __construct(Router $route)
    {
        $route->get("/exemple", function () {
            return "Propulsé par EMCX pour la communauté ClientX !";
        }, "exemple");
    }
}