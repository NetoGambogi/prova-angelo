<?php

declare(strict_types=1);

namespace App\Academico;

class AtividadeExtra
{
    public function __construct(
        private readonly string $nome,
        private readonly string $descricao,
        private readonly Professor $professorResponsavel,
        private readonly string $horario
    ) {}

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getProfessorResponsavel(): Professor
    {
        return $this->professorResponsavel;
    }

    public function getHorario(): string
    {
        return $this->horario;
    }
}