<?php

namespace App\EMCX\src\UI\Navigation;

use ClientX\Navigation\NavigationItemInterface;
use ClientX\Renderer\RendererInterface;

class EMCXAdminItem implements NavigationItemInterface
{
    public function render(RendererInterface $renderer):string
    {
        return $renderer->render('@emcx/navigation/item');
    }

    public function getPosition(): int
    {
        return 1000;
    }
}