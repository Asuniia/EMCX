<?php
namespace App\EMCX\src\UI\App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EMCXAssetExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction("asset", [$this, 'asset'])
        ];
    }

    public function asset(string $file)
    {
        return "/assets/". $file;
    }

}
