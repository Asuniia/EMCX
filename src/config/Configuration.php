<?php

namespace App\EMCX\src\config;

class Configuration
{


    protected array $config;
    protected array $items;
    const SETTINGS_FILE = '/settings.json';
    const MODULES_FILE = '/modules.json';

    public function __construct()
    {
        $this->config = json_decode(file_get_contents(dirname(__DIR__, 2) . self::SETTINGS_FILE), true);
        $this->items = json_decode(file_get_contents(dirname(__DIR__, 2) . self::MODULES_FILE), true);
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
