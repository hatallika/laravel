<?php
declare(strict_types=1);

namespace App\Contracts;

interface Parser
{
    public function load(string $link): self;
    public function start(string $schemaName): array;
}
