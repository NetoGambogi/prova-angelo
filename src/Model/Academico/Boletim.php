<?php

declare(strict_types=1);

namespace App\Academico;

final class Boletim
{
    public function __construct(
        private Aluno $aluno
    ) {}

    public function gerarConteudo(): string
    {
        $conteudo = "Boletim de {$this->aluno->getNome()} - Casa: {$this->aluno->getCasa()->value}";

        $notas = $this->aluno->getNotas();

        if (empty($notas)) {
            $conteudo .= "Nenhuma nota registrada até o momento.";
            return $conteudo;
        }

        $conteudo .= "";
        foreach ($notas as $nota) {
            $conteudo .= "{$nota->getDisciplina()->getNome()}: Nota {$nota->getValor()}";
        }
        $conteudo .= "";

        return $conteudo;
    }
}