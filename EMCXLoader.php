<?php

namespace App\EMCX;

use App\EMCX\src\config\Configuration;
use App\EMCX\src\config\Request;
use App\EMCX\src\license\LicenseBuilder;
use App\EMCX\src\loader\module\EMCXModuleBuilder;
use App\EMCX\src\module\EMCXModule;
use ClientX\App;

class EMCXLoader
{

    protected Configuration $config;
    public object $modules;
    protected Request $request;
    protected LicenseBuilder $license;
    protected App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->config = new Configuration();
        $this->request = new Request($this->config);
        $this->license = new LicenseBuilder($this->getRequest()->getClient(), $this->config, $this->request->getServerData());
        $this->modules = new EMCXModuleBuilder($this->app, $this->config->getItems());
        $this->app->addModule(EMCXModule::class);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }


    public function getConfig(): Configuration
    {
        return $this->config;
    }

    public function getLicense(): LicenseBuilder
    {
        return $this->license;
    }

    public function inject()
    {
        return $this->modules->run();
    }
}
