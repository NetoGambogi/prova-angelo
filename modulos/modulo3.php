<?php

<<<<<<< HEAD
require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\ProvaMagica;
use App\Academico\Pontuacao;
=======
declare(strict_types=1);

namespace App\Academico;

use App\Model\Academico\Desafios;
use App\Model\Academico\Torneio;
use App\Model\Academico\Pontuacao;
use App\Model\Academico\ProvaMagica;


require_once __DIR__ . '/../vendor/autoload.php';
>>>>>>> 590cdc4626579d800f70617d1ddf296c322337d2

$desafio = new ProvaMagica("Feitiço de Defesa", "Executar um feitiço de escudo", 10.0);

$avaliacoes = [
    ['casa' => 'Grifinória', 'nota' => 8.0],
    ['casa' => 'Sonserina',  'nota' => 7.5],
    ['casa' => 'Corvinal',   'nota' => 9.0],
    ['casa' => 'Lufa-Lufa',  'nota' => 6.5]
];

$pontuacao = new Pontuacao();

foreach ($avaliacoes as $avaliacao) {
    $pontos = $desafio->avaliarDesempenho($avaliacao['nota']);
    $pontuacao->adicionarPontos($avaliacao['casa'], $pontos);
}

echo "Ranking da Prova Mágica: " . $desafio->getTitulo() . "\n";
$pontuacao->exibirRanking();