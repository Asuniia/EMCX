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

    public function get(): array
    {
        return $this->config;
    }

    public function setConfig($array, $keys)
    {
        $this->config[$array] = $keys;
        $this->saveConfig($this->config);
    }

    public function saveConfig(array $config)
    {
        file_put_contents(dirname(__DIR__, 2) . self::SETTINGS_FILE, json_encode($config, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    public function setItem($item,$array, $keys)
    {
        $this->items[$item][$array] = $keys;
        $this->saveItem($this->items);
    }

    public function saveItem(array $items)
    {
        file_put_contents(dirname(__DIR__, 2) . self::MODULES_FILE, json_encode($items, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
