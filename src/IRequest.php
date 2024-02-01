<?php

declare(strict_types=1);

namespace Expando\LocoPackage;

interface IRequest
{
    public function asArray(): array;
}