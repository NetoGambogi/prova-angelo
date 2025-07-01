<?php
namespace App\Academico;

require_once __DIR__ . '/Desafio.php';

class ProvaMagica extends Desafio {
    public function __construct(string $titulo, string $descricao, float $pontuacaoMaxima) {
        parent::__construct($titulo, $descricao, $pontuacaoMaxima);
    }

    public function avaliarDesempenho(float $nota): float {
        $pontuacao = $nota * 1.1;
        return min($pontuacao, $this->pontuacaoMaxima);
    }
}