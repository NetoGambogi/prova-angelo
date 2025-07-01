<?php
namespace App\Academico;

<<<<<<< HEAD
require_once __DIR__ . '/Desafio.php';
=======
namespace App\Model\Academico;

use App\Model\Academico\Desafios;
use App\Model\Academico\Torneio;
use App\Model\Academico\Pontuacao;
use DateTime;
>>>>>>> 590cdc4626579d800f70617d1ddf296c322337d2

class ProvaMagica extends Desafios {
    public function __construct(string $titulo, string $descricao, float $pontuacaoMaxima) {
        parent::__construct($titulo, $descricao, $pontuacaoMaxima);
    }

    public function avaliarDesempenho(float $nota): float {
        $pontuacao = $nota * 1.1;
        return min($pontuacao, $this->pontuacaoMaxima);
    }
}