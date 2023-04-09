<?php

namespace App\EMCX\modules\Exemple;

use App\EMCX\EMCXLoader;
use App\EMCX\src\Loader\EMCXModuleInterface;
use ClientX\Module;
use ClientX\Router;

class EMCXExempleModule extends Module implements EMCXModuleInterface
{

    public function getName(): string
    {
        return "Exemple";
    }

    public function getVersion(): int
    {
        return 1;
    }

    public function getDescription(): string
    {
        return "Exemple de module";
    }

    public function getAuthor(): string
    {
        return "EMCX";
    }

    public function getEnabled(): bool
    {
        return true;
    }

    public Router $router;

    public function __construct(EMCXLoader $emcx)
    {
        $this->router = $emcx->getContainer(Router::class);
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $this->router->get("/exemple", function () {
            return "Exemple";
        }, "exemple");
    }

}