<?php

declare(strict_types=1);

namespace App\Model\Academico;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\ProvaMagica;
use App\Academico\Pontuacao;
use App\Academico\ConviteTorneio;
use App\Academico\Torneio;
use App\Academico\AlunoHogwarts;
use App\Academico\Casa;
use DateTime;

// Criação do Torneio Tribruxo
$torneio = new Torneio(
    'Torneio Tribruxo',
    'Castelo de Hogwarts',
    new DateTime('1994-11-24'),
    new DateTime('1994-12-20'),
);

// Criação das casas usando a classe Casa que você já criou
$casaGrifinoria = new Casa('Grifinória');
$casaLufaLufa = new Casa('Lufa-Lufa');
$casaCorvinal = new Casa('Corvinal');
$casaSonserina = new Casa('Sonserina');

// Criação dos alunos com as casas definidas
$alunos = [
    new AlunoHogwarts("Harry Potter", 18, "Masculino", "Coragem", $casaGrifinoria, 5),
    new AlunoHogwarts("Cedrico Diggory", 18, "Masculino", "Lealdade", $casaLufaLufa, 6),
    new AlunoHogwarts("Fleur Delacour", 18, "Feminino", "Determinação", $casaCorvinal, 7),
    new AlunoHogwarts("Viktor Krum", 18, "Masculino", "Coragem", $casaSonserina, 5),
];

// Função para enviar convites para vários alunos
function enviarConvites(array $alunos, Torneio $torneio) {
    $convites = [];
    foreach ($alunos as $aluno) {
        $mensagem = 'É com muita honra que convidamos você, ' . $aluno->getNome() . ', para participar do Torneio Tribruxo! E representar a sua casa: ' . $aluno->getCasa()->getNome() . '.' . "\n" .
            'Prepare-se para enfrentar uma série de desafios mágicos e perigosos! Onde o vencedor receberá um prêmio incrível!' . "\n" .
            'A TAÇA TRIBRUXO!' . "\n" .
            'Data do Torneio: ' . $torneio->getDataInicio()->format('Y-m-d') . ' até ' . $torneio->getDataFim()->format('Y-m-d') . "\n" .
            'Local: ' . $torneio->getLocal() . "\n" .
            'Boa sorte!' . "\n";

        $convite = new ConviteTorneio(
            'CONVITE PARA O TORNEIO TRIBRUXO',
            $aluno,
            $torneio,
            $torneio->getDataInicio(),
            $mensagem
        );
        $convite->aceitarConvite();
        $convites[] = $convite;
    }
    return $convites;
}

// Chamando a função corretamente
$convites = enviarConvites($alunos, $torneio);

// Exibindo os convites
foreach ($convites as $convite) {
    echo $convite->getAluno()->getNome() . ' - ';
    echo $convite->isAceito() ? 'Aceitou o convite.' : 'Recusou o convite.';
    echo PHP_EOL;
}

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