<?php

declare(strict_types=1);

namespace App\Model\Academico;
use DateTime;
use Exception;

final class Torneio
{
    private string $nome;
    private string $local;
    private DateTime $dataInicio;
    private DateTime $dataFim;
    private array $participantes = [];
    private int $pontuacao = 0;
    private Desafios $desafios;

    public function __construct(string $nome, string $local, DateTime $dataInicio, DateTime $dataFim, array $participantes = [], int $pontuacao = 0, Desafios $desafios)
    {
        $this->nome = $nome;
        $this->local = $local;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->participantes = $participantes;
        $this->pontuacao = $pontuacao;
        $this->desafios = $desafios;
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
    public function getPontuacao(): int
    {
        return $this->pontuacao;
    }
    public function getDesafios(): Desafios
    {
        return $this->desafios;
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
    public function adicionarParticipante($participante): void
    {
        $this->participantes[] = $participante;
    }
    public function getParticipantes(): array
    {
        return $this->participantes;
    }   
    public function setPontuacao(int $pontuacao): void
    {
        $this->pontuacao = $pontuacao;
    }
    public function setDesafios(Desafios $desafios): void
    {
        $this->desafios = $desafios;
    }

    public function criarTorneio(string $nome, string $local, string $dataInicio, string $dataFim): Torneio
    {
        $dataInicio = new DateTime($dataInicio);
        $dataFim = new DateTime($dataFim);

        if ($dataInicio >= $dataFim) {
            throw new Exception('A data inicial não pode ser após ou igual a data final.');
        }

        return new Torneio($nome, $local, $dataInicio, $dataFim, [], 0, new Desafios('default', 'default', $dataInicio, $dataFim, $local));
    }

    public function criarTorneioComParticipantes(
        string $nome,
        string $local,
        string $dataInicio,
        string $dataFim,
        array $participantes
    ): Torneio {
        $torneio = $this->criarTorneio($nome, $local, $dataInicio, $dataFim);
        // Adiciona os participantes ao torneio
        foreach ($participantes as $participante) {
            $torneio->adicionarParticipante($participante);
        }
        return $torneio;
    }
}