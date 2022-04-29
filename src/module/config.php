<?php

use App\EMCX\src\module\Navigation\EMCXAdminItem;
use ClientX\Navigation\DefaultMainItem;
use function DI\add;
use function DI\get;

return [
    'admin.menu.items' => add(get(EMCXAdminItem::class)),
    'navigation.main.items' => add([new DefaultMainItem([DefaultMainItem::makeItem('emcx.powered', 'https://emcx.aktech.fr', 'fa-solid fa-bolt','online')], 990)]),

];