<?php

namespace App\EMCX\src\loader\module;

use App\EMCX\src\Exception\EMCXException;
use ClientX\App;
use ClientX\Helpers\Str;

class EMCXModuleBuilder
{

    protected App $app;
    protected array $items = [];

    public function __construct(App $app, $items)
    {
        $this->app = $app;
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

    public function add()
    {


        foreach ($this->getNamespace() as $items) {
            if (class_exists($items) === false) {
                continue;
            }

            if ($items::DEFINITIONS) {
                $this->app->builder->addDefinitions($items::DEFINITIONS);
            }

            /*if ($module::TRANSLATIONS) {
                $translations = $module::TRANSLATIONS;
                foreach ($translations as $locale => $file) {
                    $this->app->translator->addTranslateResource($locale, $file);
                }
            }*/
        }
    }

    public function run()
    {
        foreach ($this->getNamespace() as $items) {
            if (class_exists($items) == false) {
                new EMCXException("A module contains an error. This can be due to the non-existence of the module or a configuration error", "EMCX_ERR_MODULES_LOAD");
            }

            return $this->app->getContainer()->get($items);
        }
        return $this->app->getContainer();
    }

    public function getNamespace(): array
    {
        return collect($this->getModulesEnabled())->filter()->map(function ($module) {
            return "App\\EMCX\\modules\\${module['type']}\\${module['name']}\\EMCX${module['name']}Module";
        })->values()->toArray();
    }
}
