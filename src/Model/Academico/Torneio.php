<?php

declare(strict_types=1);

namespace App\Model\Academico;
use DateTime;

final class Torneio
{
    private string $nome;
    private string $local;
    private DateTime $dataInicio;
    private DateTime $dataFim;
    private array $participantes = [];
    

    public function __construct(string $nome, string $local, DateTime $dataInicio, DateTime $dataFim, array $participantes = [])
    {
        $this->nome = $nome;
        $this->local = $local;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->participantes = $participantes;
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getLocal(): string
    {
        return $this->local;
    }

    public function getDataInicio(): DateTime
    {
        return $this->dataInicio;
    }

    public function getDataFim(): DateTime
    {
        return $this->dataFim;
    }
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setLocal(string $local): void
    {
        $this->local = $local;
    }

    public function setDataInicio(DateTime $dataInicio): void
    {
        $this->dataInicio = $dataInicio;
    }

    public function setDataFim(DateTime $dataFim): void
    {
        $this->dataFim = $dataFim;
    }
    public function adicionarParticipante(ParticipanteTorneio $participante): void
    {
        $this->participantes[] = $participante;
    }
    public function getParticipantes(): array
    {
        return $this->participantes;
    }
}