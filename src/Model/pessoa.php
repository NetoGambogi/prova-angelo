<?php
declare(strict_types=1);

namespace Model;

class Pessoa
{
    private string $nome;
    private int $idade;
    private string $genero;

    public function __construct(string $nome, int $idade, string $genero)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->genero = $genero;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setIdade(int $idade): void
    {
        $this->idade = $idade;
    }

    public function setGenero(string $genero): void
    {
        $this->genero = $genero;
    }
}