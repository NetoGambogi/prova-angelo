<?php

declare(strict_types=1);

<<<<<<< HEAD:src/Model/Academico/Desafio.php
namespace App\Academico;
=======
namespace App\Model\Academico;

use App\Model\Academico\Torneio;
use App\Academico\ProvaMagica;
use DateTime;
>>>>>>> 590cdc4626579d800f70617d1ddf296c322337d2:src/Model/Academico/Desafios.php

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