<?php

declare(strict_types=1);

namespace App\Academico;

final class Boletim
{
    public function gerar(Aluno $aluno): array
    {
        return $aluno->getNotas();
    }
}