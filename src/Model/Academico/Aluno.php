<?php

declare(strict_types=1);

namespace App\Academico;

require_once __DIR__ . '/Pessoa.php';


class Aluno extends Pessoa
{

    private Casa $casa;
    private int $ano;
    private array $notas = [];
    private int $pontos = 0;

    public function __construct(
        string $nome,
        int $idade,
        string $genero,
        Casa $casa,
        int $ano
    ) {
        parent::__construct($nome, $idade, $genero);
        $this->casa = $casa;
        $this->ano = $ano;
    }

    public function getCasa(): Casa
    {
        return $this->casa;
    }

    public function getAno(): int
    {
        return $this->ano;
    }

    public function adicionarNota(string $disciplina, float $nota): void
    {
        $this->notas[$disciplina][] = $nota;
    }

    public function getNotas(): array
    {
        return $this->notas;
    }

    public function getPontos(): int
    {
        return $this->pontos;
    }

    public function setPontos(int $pontos): void
    {
        $this->pontos = $pontos;
    }
}