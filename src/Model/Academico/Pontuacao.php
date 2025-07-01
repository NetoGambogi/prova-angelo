<?php
<<<<<<< HEAD
namespace App\Academico;

=======

declare(strict_types=1);

namespace App\Model\Academico;
>>>>>>> 590cdc4626579d800f70617d1ddf296c322337d2
class Pontuacao {
    private array $pontosPorCasa = [];

    public function adicionarPontos(string $casa, float $pontos): void {
        if (!isset($this->pontosPorCasa[$casa])) {
            $this->pontosPorCasa[$casa] = 0;
        }
        $this->pontosPorCasa[$casa] += $pontos;
    }

    public function getRanking(): array {
        $ranking = $this->pontosPorCasa;
        arsort($ranking);
        return $ranking;
    }

    public function exibirRanking(): void {
        foreach ($this->getRanking() as $casa => $pontos) {
            echo "$casa: $pontos\n";
        }
    }
}