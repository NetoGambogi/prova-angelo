<?php

namespace App\Model\Academico;

use App\Model\Academico\Desafios;
use App\Model\Academico\Torneio;
use App\Model\Academico\Pontuacao;
use DateTime;

class ProvaMagica extends Desafios {
    public function __construct(string $titulo, string $descricao, float $pontuacaoMaxima) {
        parent::__construct($titulo, $descricao, $pontuacaoMaxima);
    }

    public function avaliarDesempenho(float $nota): float {
        // bônus mágico de 10%
        $pontuacao = $nota * 1.1;
        return min($pontuacao, $this->pontuacaoMaxima);
    }
}