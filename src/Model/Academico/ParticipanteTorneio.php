<?php
declare(strict_types=1);

namespace App\Model\Academico;
use App\Model\Academico\Torneio;
use App\Model\Academico\AlunoHogwarts;

final class ParticipanteTorneio
{
    private AlunoHogwarts $aluno;
    private Torneio $torneio;
    private ConviteTorneio $conviteTorneio;
    private string $casa;

    public function __construct(AlunoHogwarts $aluno, Torneio $torneio, ConviteTorneio $conviteTorneio, string $casa)
    {
        $this->aluno = $aluno;
        $this->torneio = $torneio;
        $this->conviteTorneio = $conviteTorneio;
        $this->casa = $casa;
    }

    public function getAluno(): AlunoHogwarts
    {
        return $this->aluno;
    }

    public function getTorneio(): Torneio
    {
        return $this->torneio;
    }

    public function getConviteTorneio(): ConviteTorneio
    {
        return $this->conviteTorneio;
    }

    public function getCasa(): string
    {
        return $this->casa;
    }

    public function setAluno(AlunoHogwarts $aluno): void
    {
        $this->aluno = $aluno;
    }
    public function setTorneio(Torneio $torneio): void
    {
        $this->torneio = $torneio;
    }

    public function setConviteTorneio(ConviteTorneio $conviteTorneio): void
    {
        $this->conviteTorneio = $conviteTorneio;
    }

    public function setCasa(string $casa): void
    {
        $this->casa = $casa;
    }
}