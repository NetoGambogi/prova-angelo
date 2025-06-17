<?php

declare(strict_types=1);

namespace App\Shared\Contract;

interface NotificadorInterface
{
    public function notificar(string $mensagem): void;
}