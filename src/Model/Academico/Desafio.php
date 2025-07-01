<?php

declare(strict_types=1);

namespace App\Academico;

abstract class Desafio {
    protected string $titulo;
    protected string $descricao;
    protected float $pontuacaoMaxima;

    public function __construct(string $titulo, string $descricao, float $pontuacaoMaxima) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->pontuacaoMaxima = $pontuacaoMaxima;
    }

    abstract public function avaliarDesempenho(float $nota): float;

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getPontuacaoMaxima(): float {
        return $this->pontuacaoMaxima;
    }
}