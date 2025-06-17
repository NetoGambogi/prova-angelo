<?php

declare(strict_types=1);

namespace App\Shared\Contract;

use App\Academico\Casa;

interface AcaoDisciplinarInterface
{
    public function getPontos(): int;
    public function getMotivo(): string;
    public function aplicar(array &$pontosDasCasas, Casa $casa): string;
}