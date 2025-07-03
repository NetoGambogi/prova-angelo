<?php

declare(strict_types=1);

namespace App\Model\Academico;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\TorneioBruxo;
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
    new DateTime('1994-12-20')
);

// Criação das casas
$casaGrifinoria = new Casa('Grifinória');
$casaLufaLufa = new Casa('Lufa-Lufa');
$casaCorvinal = new Casa('Corvinal');
$casaSonserina = new Casa('Sonserina');

// Criação dos alunos
$alunos = [
    new AlunoHogwarts("Harry Potter", 18, "Masculino", "Coragem", $casaGrifinoria, 5),
    new AlunoHogwarts("Cedrico Diggory", 18, "Masculino", "Lealdade", $casaLufaLufa, 6),
    new AlunoHogwarts("Fleur Delacour", 18, "Feminino", "Determinação", $casaCorvinal, 7),
    new AlunoHogwarts("Viktor Krum", 18, "Masculino", "Coragem", $casaSonserina, 5),
];

// Enviar convites para os alunos
function enviarConvites(array $alunos, Torneio $torneio): array {
    $convites = [];
    foreach ($alunos as $aluno) {
        $mensagem = str_repeat('=', 115) . "\n" .
            "É com muita honra que convidamos você, {$aluno->getNome()}, para participar do Torneio Tribruxo!\n" .
            "Representando a sua casa: {$aluno->getCasa()->getNome()}.\n" .
            "Prepare-se para enfrentar desafios mágicos e perigosos!\n" .
            "O vencedor receberá um prêmio incrível: A TAÇA TRIBRUXO!\n" .
            "Data do Torneio: {$torneio->getDataInicio()->format('Y-m-d')} até {$torneio->getDataFim()->format('Y-m-d')}\n" .
            "Local: {$torneio->getLocal()}\n" .
            "Boa sorte!\n" .
            str_repeat('=', 115);

        $convites[] = new ConviteTorneio(
            'CONVITE PARA O TORNEIO TRIBRUXO',
            $aluno,
            $torneio,
            $torneio->getDataInicio(),
            $mensagem
        );
    }
    return $convites;
}

$convites = enviarConvites($alunos, $torneio);

// Função para decidir se o aluno aceita ou recusa
function decidirConvite(ConviteTorneio $convite): void {
    echo $convite->getAluno()->getNome() . ", você aceita o convite? (s ou sim/n ou não): ";
    $resposta = strtolower(trim(readline()));
    if ($resposta === 's' || $resposta === 'sim') {
        $convite->aceitarConvite();
        echo "Convite aceito por {$convite->getAluno()->getNome()}!\n\n";
    } elseif ($resposta === 'n' || $resposta === 'não') {
        $convite->recusarConvite();
        echo "Convite recusado por {$convite->getAluno()->getNome()}.\n\n";
    } else {
        echo "Resposta inválida. Consideraremos como recusado.\n\n";
        $convite->recusarConvite();
    }
}

// Executa a decisão para cada convite
$alunosAceitaram = [];
$alunosRecusaram = [];

foreach ($convites as $convite) {
    decidirConvite($convite);

    if ($convite->foiAceito()) {
        $aluno = $convite->getAluno();
        $nota = (float) readline("Digite a nota para {$aluno->getNome()}: ");
        $alunosAceitaram[] = [
            'aluno' => $aluno,
            'nota' => $nota
        ];
    } elseif ($convite->foiRecusado()) {
        $alunosRecusaram[] = $convite->getAluno()->getNome();
    }
}

// Exibir quem aceitou e recusou
echo "\n=== ALUNOS QUE RECUSARAM O CONVITE ===\n";
foreach ($alunosRecusaram as $nome) {
    echo "- $nome\n";
}

echo "\n=== SALÃO PRINCIPAL ===\n";

// Ordenar por nota (decrescente)
usort($alunosAceitaram, fn($a, $b) => $b['nota'] <=> $a['nota']);

// Exibir ranking
$pos = 1;
foreach ($alunosAceitaram as $item) {
    $aluno = $item['aluno'];
    $nota = $item['nota'];
    echo "{$pos}º - {$aluno->getNome()} ({$aluno->getCasa()->getNome()}) - Nota: {$nota}\n";
    $pos++;
}