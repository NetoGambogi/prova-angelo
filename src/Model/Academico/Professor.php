<?php

declare(strict_types=1);

namespace App\Academico;

final class Professor extends Pessoa
{

    /** @var Disciplina[] */
    private array $disciplinasLecionadas = [];
     /** @var Turma[] */
    private array $turmas = [];
    /** @var AtividadeExtra[] */
    private array $atividadesExtras = [];
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

     /**
     * Adiciona uma turma à lista de turmas do professor.
     * @param Turma $turma
     */
    public function adicionarTurma(Turma $turma): void
    {
        $this->turmas[] = $turma;
    }

    /**
     * Retorna a lista de turmas do professor.
     * @return Turma[]
     */
    public function getTurmas(): array
    {
        return $this->turmas;
    }

    /**
     * Adiciona uma atividade extra à lista do professor.
     * @param AtividadeExtra $atividade
     */
    public function adicionarAtividadeExtra(AtividadeExtra $atividade): void
    {
        $this->atividadesExtras[] = $atividade;
    }

    /**
     * Retorna a lista de atividades extras do professor.
     * @return AtividadeExtra[]
     */
    public function getAtividadesExtras(): array
    {
        return $this->atividadesExtras;
    }
}