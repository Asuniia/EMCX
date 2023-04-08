<?php

namespace App\EMCX\src\loader\module;

use App\EMCX\EMCXLoader;
use App\EMCX\src\Exception\EMCXException;

class EMCXModuleBuilder
{

    protected EMCXLoader $emcx;
    protected EMCXModuleInterface $modules;

    public function __construct(EMCXLoader $emcx)
    {
        $this->emcx = $emcx;
    }

    public function getModuleConfig(string $module): array
    {

        if (!file_exists($this->getDir() . $module . DIRECTORY_SEPARATOR . "config.php")) {
            new EMCXException("Module config not found for " . $module, "MODULE_CONFIG_NOT_FOUND");
        }

        $config = require $this->getDir() . $module . DIRECTORY_SEPARATOR . "config.php";
        return $config;
    }

    public function getModuleNamespace(string $module): string
    {

        return "App\\EMCX\\modules\\" . $module . "\\EMCX" . $module . "Module";
    }

    public function getModules(): EMCXModuleInterface
    {
        return $this->modules;
    }

    public function addModule(EMCXModuleInterface $module): void
    {
        $this->modules = $module;
    }


    public function getModulesInDir() {
        $modules = scandir($this->getDir());
        $modules = array_diff($modules, [".", ".."]);
        $modules = array_values($modules);
        return $modules;
    }

    public function getDir(): string
    {
        return dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "modules" . DIRECTORY_SEPARATOR;
    }

    public function run()
    {
        $modules = $this->getModulesInDir();

        foreach ($modules as $module) {


            $config = $this->getModuleConfig($module);

            if(!isset($config["name"]) || !isset($config["version"]) || !isset($config["description"]) || !isset($config["author"]) || !isset($config["enabled"])) {
                new EMCXException("Module config not valid for " . $module, "MODULE_CONFIG_NOT_VALID");
            }

            if($config["enabled"] == false) {
                continue;
            }

            $namespace = $this->getModuleNamespace($module);
            
            if (!class_exists($namespace)) {
                new EMCXException("Module class not found for " . $module, "MODULE_CLASS_NOT_FOUND");
            }

            $this->emcx->getApp()->addModule($namespace);
        }

        return $this->emcx->getApp()->getContainer();
    }

}
