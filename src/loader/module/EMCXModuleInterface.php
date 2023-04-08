<?php

namespace App\EMCX\src\loader\module;

interface EMCXModuleInterface
{

    /**
     *
     * @return string
     */
    public function getName(): string;
    /**
     *
     * @return int
     */
    public function getVersion(): int;
    /**
     *
     * @return string
     */
    public function getDescription(): string;
    /**
     *
     * @return string
     */
    public function getAuthor(): string;

    /**
     *
     * @return bool
     */
    public function getPrivate(): bool;

    /**
     *
     * @return float
     */
    public function getPrice(): float;
}