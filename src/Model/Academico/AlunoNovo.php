<?php

declare(strict_types=1);

use App\Academico\Aluno;
use App\Academico\Pessoa;
use App\Academico\Casa;

class AlunoHogwarts extends Aluno
{
    protected string $traco;
    private Casa $casa;
    private string $sangue;
    private int $ano;

    public function __construct(string $nome, int $idade, string $genero, string $traco, Casa $casa, int $ano)
    {
        parent::__construct($nome, $idade, $genero, $casa, $ano);
        $this->traco = $traco;
        $this->casa = $casa;
        $this->ano = $this->validarAno($ano);
        $this->sangue = $this->sortearTipoDeSangue();
    }

    public function getTraco(): string
    {
        return $this->traco;
    }

    public function setTraco(string $traco): void
    {
        $this->traco = $traco;
    }

  public function getCasa(): Casa
    {
        return $this->casa;
    }

    public function setCasa(Casa $casa): void
    {
        $this->casa = $casa;
    }

    public function getSangue(): string
    {
        return $this->sangue;
    }

    public function setSangue(string $sangue): void
    {
        $this->sangue = $sangue;
    }

    public function getAno(): int
    {
        return $this->ano;
    }

    public function setAno(int $ano): void
    {
        $this->ano = $this->validarAno($ano);
    }

    private function sortearTipoDeSangue(): string
    {
        $tipos = ['Puro-sangue', 'Mestiço', 'Nascido trouxa'];
        return $tipos[array_rand($tipos)];
    }

    private function validarAno(int $ano): int
    {
        if ($ano >= 2 && $ano <= 7) {
            return $ano;
        } else {
            throw new \InvalidArgumentException("Ano inválido: deve estar entre 2º e 7º ano.");
        }
    }

    public function getResumo(): string
    {
        return "Resumo do Aluno Hogwarts:\n" .
            "Nome: {$this->getNome()}\n" .
            "Casa: {$this->casa->getNome()}\n" .
            "Ano: {$this->ano}\n" .
            "Traço: {$this->traco}\n" .
            "Tipo de sangue: {$this->sangue}";
    }
}