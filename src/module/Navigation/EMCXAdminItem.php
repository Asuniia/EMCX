<?php

namespace App\EMCX\src\module\Navigation;

use ClientX\Navigation\NavigationItemInterface;
use ClientX\Renderer\RendererInterface;

class EMCXAdminItem implements NavigationItemInterface
{
    public function render(RendererInterface $renderer):string
    {
        return $renderer->render('@emcx_admin/item');
    }

    public function getPosition(): int
    {
        return 40;
    }
}