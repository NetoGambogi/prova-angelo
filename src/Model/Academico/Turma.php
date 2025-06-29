<?php

declare(strict_types=1);

namespace App\Academico;

use Exception;

class Turma
{
    /** @var Aluno[] */
    private array $alunos = [];

    /**
     * Construtor da Turma.
     * Demonstra Composição (valida se o professor pode lecionar a disciplina)
     * e Agregação (recebe objetos que existem independentemente).
     */
    public function __construct(
        private readonly string $nome,
        private readonly Disciplina $disciplina,
        private readonly Professor $professor,
        private readonly string $horario
    ) {
        // Validação para garantir que o professor da turma é o mesmo da disciplina
        if ($this->disciplina->getProfessor() !== $this->professor) {
            throw new Exception("O professor {$this->professor->getNome()} não pode ser associado à turma de {$this->disciplina->getNome()}, pois quem a leciona é {$this->disciplina->getProfessor()->getNome()}.");
        }
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDisciplina(): Disciplina
    {
        return $this->disciplina;
    }

    public function getProfessor(): Professor
    {
        return $this->professor;
    }

    public function getHorario(): string
    {
        return $this->horario;
    }

    /** @return Aluno[] */
    public function getAlunos(): array
    {
        return $this->alunos;
    }
}