<?php

namespace App\EMCX\src\UI;

use App\EMCX\src\UI\App\Controller\EMCXIndexController;
use App\EMCX\src\UI\App\Extension\EMCXAssetExtension;
use ClientX\Module;
use ClientX\Renderer\RendererInterface;
use ClientX\Router;
use Psr\Container\ContainerInterface;
use ClientX\Renderer\TwigRenderer;

class EMCXInterfaceModule extends Module {

    const DEFINITIONS = __DIR__ . '/config.php';

    const TRANSLATIONS = [
        "fr_FR" => __DIR__ . "/Locale/fr_FR.php",
    ];
    public function __construct(RendererInterface $renderer, Router $router, ContainerInterface  $container) {

        if ($renderer instanceof TwigRenderer) {
            $renderer->getTwig()->addExtension(new EMCXAssetExtension());
        }

        if ($container->has('admin.prefix')) {
            $prefix = $container->get('admin.prefix');
            $router->get($prefix . "/emcx", EMCXIndexController::class, 'admin.emcx.index');
        }
    $renderer->addPath('emcx', __DIR__ . '/Resources/views');
    }

}