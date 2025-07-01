<?php

namespace App\Model\Academico;
namespace App\Model\Desafios;
use DateTime;

class ProvaMagica extends Desafio {
    public function __construct(string $titulo, string $descricao, float $pontuacaoMaxima) {
        parent::__construct($titulo, $descricao, $pontuacaoMaxima);
    }

    public function avaliarDesempenho(float $nota): float {
        // bônus mágico de 10%
        $pontuacao = $nota * 1.1;
        return min($pontuacao, $this->pontuacaoMaxima);
    }
}