<?php
    declare(strict_types=1);

    namespace App\Service;

    use App\Academico\Mensagem;
    use App\Shared\Event\NotificadorTerminal;
    use DateTime;

    class ServicoDeMensagens {
    private array $fila = [];
    private array $mensagensEnviadas = [];

    public function __construct(private \App\Shared\Event\NotificadorTerminal $notificador) {}

    public function enviarMensagem(Mensagem $mensagem): void
    {
        if ($mensagem->getDataAgendada() === null || $mensagem->getDataAgendada() <= new DateTime()) {
            $this->notificador->notificar($mensagem->getConteudo());
            $this->mensagensEnviadas[] = $mensagem;
        } else {
            $this->fila[] = $mensagem;
        }
    }

    public function processarFila(): void
    {
        $agora = new DateTime();
        foreach ($this->fila as $key => $mensagem) {
            if ($mensagem->getDataAgendada() <= $agora) {
                $this->notificador->notificar($mensagem->getConteudo());
                $this->mensagensEnviadas[] = $mensagem;
                unset($this->fila[$key]);
            }
        }
    }

    public function getMensagensEnviadas(): array
    {
        return $this->mensagensEnviadas;
    }
}