<?php

declare(strict_types=1);

namespace App\Model\Academico;
use DateTime;

final class Desafios
{
    private string $tipo;
    private string $regras;
    private DateTime $dataInicio;
    private DateTime $dataFim;
    private string $local;
    
    public function __construct(string $tipo, string $regras, DateTime $dataInicio, DateTime $dataFim, string $local)
    {
        $this->tipo = $tipo;
        $this->regras = $regras;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->local = $local;
    }
    public function getTipo(): string
    {
        return $this->tipo;
    }
    public function getRegras(): string
    {
        return $this->regras;
    }
    public function getDataInicio(): DateTime
    {
        return $this->dataInicio;
    }
    public function getDataFim(): DateTime
    {
        return $this->dataFim;
    }
    public function getLocal(): string
    {
        return $this->local;
    }
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }
    public function setRegras(string $regras): void
    {
        $this->regras = $regras;
    }
    public function setDataInicio(DateTime $dataInicio): void
    {
        $this->dataInicio = $dataInicio;
    }
    public function setDataFim(DateTime $dataFim): void
    {
        $this->dataFim = $dataFim;
    }
    public function setLocal(string $local): void
    {
        $this->local = $local;
    }
}