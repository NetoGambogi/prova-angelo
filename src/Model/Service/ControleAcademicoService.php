<?php

declare(strict_types=1);

namespace App\Service;

use App\Academico\Aluno;
use App\Academico\Disciplina;
use App\Academico\Professor;
use App\Shared\Contract\NotificadorInterface;
use Exception;

final class ControleAcademicoService
{
    public function __construct(
        private readonly NotificadorInterface $notificador
    ) {}

    public function registrarNota(Professor $professor, Aluno $aluno, Disciplina $disciplina, float $valor): void
    {
        if ($disciplina->getProfessor() !== $professor) {
            throw new Exception("{$professor->getNome()} não pode lançar notas em {$disciplina->getNome()}.");
        }


        $aluno->adicionarNota($disciplina->getNome(), $valor);

        $this->notificador->notificar("✅ Nota de {$aluno->getNome()} em {$disciplina->getNome()} registrada.");
    }
}