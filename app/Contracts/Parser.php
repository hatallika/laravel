<?php
declare(strict_types=1);

namespace App\Contracts;

use voku\helper\ASCII;

interface Parser
{
    public function load(string $link): self;
    public function start(string $schemaName): array;
}
