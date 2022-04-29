<?php

use App\Shop\Navigations\Items\ShopMainItem;
use function ClientX\setting;
use function DI\add;
use function DI\autowire;
use function DI\factory;
use function DI\get;

return [
    'navigation.main.items' => add([get(ShopMainItem::class)]),
];