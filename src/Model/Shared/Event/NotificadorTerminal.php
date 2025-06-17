<?php

declare(strict_types=1);

namespace App\Shared\Event;

use App\Shared\Contract\NotificadorInterface;

class NotificadorTerminal implements NotificadorInterface
{
    public function notificar(string $mensagem): void
    {
        echo $mensagem . PHP_EOL;
    }
}