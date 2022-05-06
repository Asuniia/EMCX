<?php

namespace App\EMCX\src\loader\module;

use App\EMCX\EMCXLoader;
use App\EMCX\src\Exception\EMCXException;
use ClientX\App;
use ClientX\Helpers\Str;

class EMCXModuleBuilder
{

    protected EMCXLoader $emcx;
    protected array $items = [];

    public function __construct(EMCXLoader $emcx, $items)
    {
        $this->emcx = $emcx;
        $this->items = $items;
    }

    public function getModules(): array
    {
        return collect($this->items)->filter()->map(function ($items) {
            return $items;
        })->toArray();
    }

    public function getModulesEnabled(): array
    {
        return collect($this->getModules())->filter(function ($items) {
            return $items['enabled'] ?? $items;
        })->toArray();
    }

    public function getModulesPublic(): array
    {
        return collect($this->getModules())->filter(function ($items) {
            return $items['public'] ?? $items;
        })->toArray();
    }

    public function run()
    {

        foreach ($this->getNamespace() as $items) {
            if (!class_exists($items)) {
                new EMCXException("A module contains an error. This can be due to the non-existence of the module or a configuration error", "EMCX_ERR_MODULES_LOAD");
            }

            if ($items::DEFINITIONS) {
                $this->emcx->getApp()->builder->addDefinitions($items::DEFINITIONS);
            }

            $this->emcx->getApp()->getContainer()->get($items);
        }
        return $this->emcx->getApp()->getContainer();
    }

    public function getNamespace(): array
    {
        return collect($this->getModulesEnabled())->filter()->map(function ($module) {
            return "App\\EMCX\\modules\\${module['type']}\\${module['name']}\\EMCX${module['name']}Module";
        })->values()->toArray();
    }
}
