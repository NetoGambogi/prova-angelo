<?php

declare(strict_types=1);

namespace App\Shared\Event;

use App\Academico\Casa;
use App\Shared\Contract\AcaoDisciplinarInterface;

class Penalidade implements AcaoDisciplinarInterface
{
    public function __construct(
        private int $pontos,
        private string $motivo
    ) {}

    public function getPontos(): int
    {
        return $this->pontos;
    }

    public function getMotivo(): string
    {
        return $this->motivo;
    }

    public function aplicar(array &$pontosDasCasas, Casa $casa): string
    {
        $nomeCasa = $casa->getNome();
        if (!isset($pontosDasCasas[$nomeCasa])) {
            $pontosDasCasas[$nomeCasa] = 0;
        }
        $pontosDasCasas[$nomeCasa] -= $this->pontos;
        return "❌ PENALIDADE: -$this->pontos pontos para a {$casa->getNome()}. Motivo: $this->motivo.";
    }
}