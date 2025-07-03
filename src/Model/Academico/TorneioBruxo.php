<?php
namespace App\Academico;

use DateTime;

require_once __DIR__ . '/Desafio.php';

class TorneioBruxo extends Desafio {
    private string $local;
    private DateTime $dataHora;
    private string $regra;

    public function __construct(
        string $titulo,
        string $regra,
        float $pontuacaoMaxima,
        string $local,
        DateTime $dataHora
    ) {
        parent::__construct($titulo, $regra, $pontuacaoMaxima);
        $this->regra = $regra;
        $this->local = $local;
        $this->dataHora = $dataHora;
    }

    public function getLocal(): string {
        return $this->local;
    }

    public function getDataHora(): DateTime {
        return $this->dataHora;
    }

    public function getRegra(): string {
        return $this->regra;
    }

    public function avaliarDesempenho(float $nota): float {
        $pontuacao = $nota * 1.1;
        return min($pontuacao, $this->pontuacaoMaxima);
    }
}