<?php
namespace App\EMCX\src\module;

use App\EMCX\EMCXLoader;
use App\EMCX\src\module\Action\EMCXIndexAction;
use App\EMCX\src\module\Action\EMCXModuleAction;
use App\EMCX\src\module\Action\EMCXModuleDownloadAction;
use App\EMCX\src\module\Action\EMCXPingAction;
use App\EMCX\src\module\Action\EMCXServerJoinAction;
use App\EMCX\src\module\Action\EMCXServersAction;
use ClientX\Module;
use ClientX\Renderer\RendererInterface;
use ClientX\Router;
use Psr\Container\ContainerInterface;

class EMCXModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    const TRANSLATIONS = [
        "fr_FR" => __DIR__ . "/trans/fr.php",
        "en_GB" => __DIR__ . "/trans/en.php",
    ];

    public function __construct(RendererInterface $renderer, Router $router, ContainerInterface  $container)
    {
        if ($container->has('admin.prefix')) {
            $prefix = $container->get('admin.prefix');
            $router->get($prefix . "/emcx", EMCXIndexAction::class, 'admin.emcx.index');
            $router->get($prefix . "/emcx/servers", EMCXServersAction::class, 'admin.emcx.servers');
            $router->get($prefix . "/emcx/servers/join/[:name]", EMCXServerJoinAction::class, 'admin.emcx.servers.join');
            $router->get($prefix . "/emcx/servers/logout", EMCXServerJoinAction::class, 'admin.emcx.servers.logout');
            $router->post($prefix . "/emcx/module/[:name]/switch", EMCXModuleAction::class, 'admin.emcx.module.switch');
            $router->get($prefix . "/emcx/module/download/[:name]", EMCXModuleDownloadAction::class, 'admin.emcx.module.download');
        }
        $router->get("/emcx/ping", EMCXPingAction::class, 'emcx.ping');
        $router->get("/emcx/repository", EMCXModuleAction::class, 'emcx.repository');
        $renderer->addPath('emcx_admin', __DIR__ . '/Views');
    }
}
