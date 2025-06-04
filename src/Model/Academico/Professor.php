<?php
declare(strict_types=1);

namespace App\Academico;

use App\Pessoa;

final class Professor extends Pessoa
{
    public function __construct(string $nome, int $idade, string $genero)
    {
        parent::__construct($nome, $idade, $genero);
    }

    public function registrarNota(Aluno $aluno, string $disciplina, float $nota): void
    {
        $aluno->adicionarNota($disciplina, $nota);
    }
}