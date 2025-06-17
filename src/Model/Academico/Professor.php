<?php

declare(strict_types=1);

namespace App\Academico;

final class Professor extends Pessoa
{

    /** @var Disciplina[] */
    private array $disciplinasLecionadas = [];
    public function __construct(
        string $nome,
        int $idade,
        string $genero
    ) {

        // Chama o construtor da classe pai (Pessoa)
        parent::__construct($nome, $idade, $genero);
    }

    // NOVO MÉTODO: para adicionar uma disciplina à lista do professor
    public function adicionarDisciplina(Disciplina $disciplina): void
    {
        // Adiciona a disciplina à lista interna
        $this->disciplinasLecionadas[] = $disciplina;
    }

    // NOVO MÉTODO: para que possamos consultar a lista de disciplinas
    /** @return Disciplina[] */
    public function getDisciplinasLecionadas(): array
    {
        return $this->disciplinasLecionadas;
    }
}