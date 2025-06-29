<?php
    declare(strict_types=1);

    namespace App\Academico;

    use DateTime;

    final class Mensagem {
        public function __construct(
        private string $conteudo,
        private Pessoa $remetente,
        /** @var Pessoa[] */
        private array $destinatarios,
        private DateTime $dataEnvio,
        private ?DateTime $dataAgendada = null,
        private bool $enviada = false
    ) {}

    public function getConteudo(): string
    {
        return $this->conteudo;
    }

    public function getRemetente(): Pessoa
    {
        return $this->remetente;
    }

    /** @return Pessoa[] */
    public function getDestinatarios(): array
    {
        return $this->destinatarios;
    }

    public function getDataEnvio(): DateTime
    {
        return $this->dataEnvio;
    }

    public function getDataAgendada(): ?DateTime
    {
        return $this->dataAgendada;
    }

    public function isEnviada(): bool
    {
        return $this->enviada;
    }

    public function marcarComoEnviada(): void
    {
        $this->enviada = true;
    }
}