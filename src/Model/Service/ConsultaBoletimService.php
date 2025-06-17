<?php

declare(strict_types=1);

namespace App\Service;

use App\Academico\Aluno;
use App\Shared\Contract\NotificadorInterface;

final class ConsultaBoletimService
{
    public function __construct(
        private readonly NotificadorInterface $notificador
    ) {}

    public function consultar(Aluno $aluno): void
    {
        $this->notificador->notificar("--------------------------------------------------");
        // Usa getCasa() que agora retorna uma string
        $nomeDaCasa = $aluno->getCasa()->getNome();
        $this->notificador->notificar("📄 BOLETIM DE: " . strtoupper($aluno->getNome()) . " | CASA: " . $nomeDaCasa);
        $this->notificador->notificar("--------------------------------------------------");

        $notasPorDisciplina = $aluno->getNotas();

        if (empty($notasPorDisciplina)) {
            $this->notificador->notificar("   Nenhuma nota registrada até o momento.");
            $this->notificador->notificar("");
            return;
        }

        // O loop itera sobre o array associativo de notas
        foreach ($notasPorDisciplina as $disciplinaNome => $notas) {
            // Converte o array de notas em uma string (ex: "10.0, 8.5")
            $notasStr = implode(', ', $notas);
            $this->notificador->notificar(
                sprintf("   - %-30s Notas: %s", $disciplinaNome . ':', $notasStr)
            );
        }
        $this->notificador->notificar(""); // Linha em branco para espaçamento
    }
}