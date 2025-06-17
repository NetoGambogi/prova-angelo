<?php

declare(strict_types=1);

namespace App\Academico;


class Casa
{
    public function __construct(
        private readonly string $nome
    ) {}

    public function getNome(): string
    {
        return $this->nome;
    }
}
