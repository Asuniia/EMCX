<?php

use App\Shop\Navigations\Items\ShopMainItem;
use function DI\add;
use function DI\get;

return [
    'name' => 'Exemple',
    'description' => 'Exemple de module',
    'version' => '1.0.0',
    'author' => 'EMCX',
    'enabled' => true,
    'navigation.main.items' => add([get(ShopMainItem::class)]),
];