<?php

declare(strict_types=1);

namespace App\Academico;

final class Disciplina
{
    public function __construct(
        private string $nome,
        private Professor $professor
    ) {
        // A disciplina, ao ser criada, se adiciona à lista do seu professor.
        $this->professor->adicionarDisciplina($this);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getProfessor(): Professor
    {
        return $this->professor;
    }
}