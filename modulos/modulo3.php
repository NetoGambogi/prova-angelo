<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\Pontuacao;
use App\Academico\Desafios;
use App\Academico\ProvaMagica;

// Instanciando desafio mágico
$desafio1 = new ProvaMagica("Feitiço de Defesa", "Executar um feitiço de escudo", 10.0);

// Notas recebidas por casa
$avaliacoes = [
    ['casa' => 'Grifinória', 'nota' => 8.0],
    ['casa' => 'Sonserina',  'nota' => 7.5],
    ['casa' => 'Corvinal',   'nota' => 9.0],
    ['casa' => 'Lufa-Lufa',  'nota' => 6.5]
];

// Pontuação
$pontuacao = new Pontuacao();

foreach ($avaliacoes as $avaliacao) {
    $casa = $avaliacao['casa'];
    $nota = $avaliacao['nota'];
    $pontos = $desafio1->avaliarDesempenho($nota);
    $pontuacao->adicionarPontos($casa, $pontos);
}

// Exibir resultado
echo "Ranking da Prova Mágica - " . $desafio1->getTitulo() . ":\n";
$pontuacao->exibirRanking();