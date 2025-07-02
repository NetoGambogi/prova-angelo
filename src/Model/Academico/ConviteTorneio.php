<?php

declare(strict_types=1);

namespace App\Academico;

use DateTime;

class ConviteTorneio
{
    private string $convite;
    private AlunoHogwarts $aluno;
    private Torneio $torneio;
    private DateTime $dataConvite;
    private string $informacoes;
    private bool $aceito = false;
    private bool $respondido = false;

    public function __construct(string $convite, AlunoHogwarts $aluno, Torneio $torneio, DateTime $dataConvite, string $informacoes){
        $this->convite = $convite;
        $this->aluno = $aluno;
        $this->torneio = $torneio;
        $this->dataConvite = $dataConvite;
        $this->informacoes = $informacoes;
    }

    public function getConvite(): string
    {
        return $this->convite;
    }
    public function getAluno(): AlunoHogwarts
    {
        return $this->aluno;
    }
    public function getTorneio(): Torneio
    {
        return $this->torneio;
    }
    public function getDataConvite(): DateTime
    {
        return $this->dataConvite;
    }
    public function getInformacoes(): string
    {
        return $this->informacoes;
    }
    public function isAceito(): bool
    {
        return $this->aceito;
    }
    public function setConvite(string $convite): void
    {
        $this->convite = $convite;
    }
    public function setAluno(AlunoHogwarts $aluno): void
    {
        $this->aluno = $aluno;
    }
    public function setTorneio(Torneio $torneio): void
    {
        $this->torneio = $torneio;
    }
    public function setDataConvite(DateTime $dataConvite): void
    {
        $this->dataConvite = $dataConvite;
    }
    public function setInformacoes(string $informacoes): void
    {
        $this->informacoes = $informacoes;
    }
    public function setAceito(bool $aceito): void
    {
        $this->aceito = $aceito;
        $this->respondido = true;
    }
    public function aceitarConvite(): void
    {
        $this->aceito = true;
        $this->respondido = true;
    }

    public function recusarConvite(): void
    {
        $this->aceito = false;
        $this->respondido = true;
    }
    public function foiAceito(): bool
    {
        return $this->respondido && $this->aceito;
    }

    public function foiRecusado(): bool
    {
        return $this->respondido && !$this->aceito;
    }

    public function foiRespondido(): bool
    {
        return $this->respondido;
    }
}
