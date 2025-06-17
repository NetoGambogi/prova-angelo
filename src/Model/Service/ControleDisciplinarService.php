<?php

declare(strict_types=1);

namespace App\Service;

use App\Academico\Casa;
use App\Shared\Contract\AcaoDisciplinarInterface;
use App\Shared\Contract\NotificadorInterface;

final class ControleDisciplinarService
{
    private array $pontosDasCasas = [];

    public function __construct(
        private readonly NotificadorInterface $notificador
    ) {
        // O construtor não precisa mais inicializar as casas.
        // Elas serão adicionadas dinamicamente quando receberem a primeira ação.
    }

    public function aplicarAcao(AcaoDisciplinarInterface $acao, Casa $casa): void
    {
        // A lógica agora está encapsulada nas classes Bonus/Penalidade
        $mensagem = $acao->aplicar($this->pontosDasCasas, $casa);
        $this->notificador->notificar($mensagem);
    }

    public function exibirPontuacaoDasCasas(): void
    {
        // Ordena as casas pela pontuação
        arsort($this->pontosDasCasas);

        $this->notificador->notificar("========================================");
        $this->notificador->notificar("🏆 PONTUAÇÃO ATUAL DA COPA DAS CASAS 🏆");
        $this->notificador->notificar("========================================");
        $this->notificador->notificar(sprintf("%-15s | %s", "Casa", "Pontos"));
        $this->notificador->notificar(str_repeat('-', 30));

        if (empty($this->pontosDasCasas)) {
            $this->notificador->notificar("Nenhuma casa pontuou ainda.");
        } else {
            // Itera diretamente sobre o array de pontos
            foreach ($this->pontosDasCasas as $nomeCasa => $pontos) {
                $this->notificador->notificar(sprintf("%-15s | %d", $nomeCasa, $pontos));
            }
        }
        $this->notificador->notificar("========================================");
    }
}