<?php

namespace App\EMCX;

use App\EMCX\src\loader\module\EMCXModuleBuilder;
use App\EMCX\src\UI\EMCXInterfaceModule;
use ClientX\App;

class EMCXLoader
{
    protected EMCXModuleBuilder $modules;
    protected App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->modules = new EMCXModuleBuilder($this);
        $this->app->addModule(EMCXInterfaceModule::class);
    }

    public function getApp(): App
    {
        return $this->app;
    }

    public function inject()
    {
        return $this->modules->run();
    }
}
