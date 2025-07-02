<?php

declare(strict_types=1);

namespace App\Academico;

use App\Academico\Aluno;
use App\Academico\Carta;
use App\Academico\Casa;

final class AlunoNovo extends Aluno
{
    private string $traco;
    private string $sangue;
    private bool $cartaAceita = false;
    private ?Carta $carta = null;//tem erro, pois a classe carta ainda não foi colocada.

    public function __construct(
        string $nome,
        int $idade,
        string $genero,
        Casa $casa,
        int $ano,
        string $traco
    ) {
        parent::__construct($nome, $idade, $genero, $casa, $ano);
        $this->traco = $traco;
        $this->sangue = $this->sortearTipoDeSangue();
    }

    private function sortearTipoDeSangue(): string
    {
        $tipos = ['Puro-sangue', 'Mestiço', 'Nascido trouxa'];
        return $tipos[array_rand($tipos)];
    }

    public function receberCarta(Carta $carta): void
    {
        $this->carta = $carta;
    }

    public function aceitarCarta(): void
    {
        if ($this->carta !== null) {
            $this->cartaAceita = true;
        }
    }

    public function getTraco(): string
    {
        return $this->traco;
    }

    public function setTraco(string $traco): void
    {
        $this->traco = $traco;
    }

    public function getSangue(): string
    {
        return $this->sangue;
    }

    public function setSangue(string $sangue): void
    {
        $this->sangue = $sangue;
    }

    public function getCarta(): ?Carta
    {
        return $this->carta;
    }

    public function setCarta(?Carta $carta): void
    {
        $this->carta = $carta;
    }

    public function cartaFoiAceita(): bool
    {
        return $this->cartaAceita;
    }

    public function setCartaAceita(bool $aceita): void
    {
        $this->cartaAceita = $aceita;
    }

    // Método polimórfico sobrescrito
    public function getResumo(): string
    {
        if (!$this->cartaAceita) {
            return "O aluno {$this->getNome()} ainda não aceitou a carta de Hogwarts.";
        }

        return "Resumo do Aluno Novo:\n" .
            "Nome: {$this->getNome()}\n" .
            "Traço: {$this->traco}\n" .
            "Tipo de sangue: {$this->sangue}\n" .
            "Carta aceita: Sim";
    }
}