<?php

declare(strict_types=1);

namespace App\Model\Academico;
use DateTime;
use App\Model\Academico\Torneio;
use App\Model\Academico\AlunoHogwarts;

class ConviteTorneio
{
    private string $convite;
    private AlunoHogwarts $aluno;
    private Torneio $torneio;
    private DateTime $dataConvite;
    private string $informacoes;
    private bool $aceito;

    public function __construct(string $convite, AlunoHogwarts $aluno, Torneio $torneio, DateTime $dataConvite, string $informacoes)
    {
        $this->convite = $convite;
        $this->aluno = $aluno;
        $this->torneio = $torneio;
        $this->dataConvite = $dataConvite;
        $this->informacoes = $informacoes;
        $this->aceito = false; // Convite não aceito por padrão
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
    }

    public function aceitarConvite(): void
    {
        $this->aceito = true;
    }

    public function recusarConvite(): void
    {
        $this->aceito = false;
    }
    public function enviarConvite(): void
    {
        $convite = new ConviteTorneio(
            $this->convite,
            $this->aluno,
            $this->torneio,
            new DateTime(),
            "Convite para o torneio: {$this->torneio->getNome()}" . PHP_EOL .
            "Local: {$this->torneio->getLocal()}" . PHP_EOL .
            "Data de Início: {$this->torneio->getDataInicio()->format('Y-m-d H:i:s')}" . PHP_EOL .
            "Data de Finalização: {$this->torneio->getDataFim()->format('Y-m-d H:i:s')}" . PHP_EOL .
            "Informações: {$this->informacoes}"
        );
        $convite->aceitarConvite();

        if ($convite->isAceito()) {
            echo "Convite aceito por {$convite->getAluno()->getNome()} para o torneio {$convite->getTorneio()->getNome()}." . PHP_EOL;
        } else {
            echo "Convite recusado por {$convite->getAluno()->getNome()} para o torneio {$convite->getTorneio()->getNome()}." . PHP_EOL;
        }

    }
}