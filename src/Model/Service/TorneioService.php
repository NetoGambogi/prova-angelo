<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Academico\Torneio;
use DateTime;
use Exception;

class TorneioService
{
    public function criarTorneio(string $nome, string $local, string $dataInicio, string $dataFim): Torneio
    {
        $dataInicio = new DateTime($dataInicio);
        $dataFim = new DateTime($dataFim);

        if ($dataInicio >= $dataFim) {
            throw new Exception('A data inicial não pode ser após ou igual a data final.');
        }

        return new Torneio($nome, $local, $dataInicio, $dataFim);
    }

    public function criarTorneioComParticipantes(
        string $nome,
        string $local,
        string $dataInicio,
        string $dataFim,
        array $participantes
    ): Torneio {
        $torneio = $this->criarTorneio($nome, $local, $dataInicio, $dataFim);
        // Adiciona os participantes ao torneio
        foreach ($participantes as $participante) {
            $torneio->adicionarParticipante($participante);
        }
        return $torneio;
    }
}