<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Model/Academico/AlunoHogwarts.php';
require_once __DIR__ . '/../src/Model/Academico/AlunoNovo.php';
require_once __DIR__ . '/../src/Model/Academico/Casa.php';
require_once __DIR__ . '/../src/Model/Academico/Carta.php';

use App\Academico\AlunoHogwarts;
use App\Academico\AlunoNovo;
use App\Academico\Casa;
use App\Academico\Carta;

// Função auxiliar para ler do terminal
function input(string $prompt): string
{
    echo $prompt;
    return trim(fgets(STDIN));
}

// Função que mapeia características para casas
function determinarCasa(string $caracteristica): string {
    return match (strtolower($caracteristica)) {
        'coragem' => 'Grifinória',
        'ambição' => 'Sonserina',
        'lealdade' => 'Lufa-Lufa',
        'inteligência' => 'Corvinal',
        default => 'Indefinido',
    };
}

// Cadastro interativo
echo "=== Cadastro de Aluno ===\n";
echo "1. Aluno de Hogwarts\n";
echo "2. Aluno Novo\n";

$opcao = input("Escolha o tipo de aluno (1 ou 2): ");

$nome = input("Nome: ");
$genero = input("Gênero (M/F/Outro): ");
$traco = input("Traço de personalidade (coragem, ambição, lealdade, inteligência): ");

// Criar casas
$casas = [
    new Casa("Grifinória"),
    new Casa("Sonserina"),
    new Casa("Lufa-Lufa"),
    new Casa("Corvinal"),
];

// Determinar a casa automaticamente pelo traço
$nomeCasaEscolhida = determinarCasa($traco);

$casaEscolhida = null;
foreach ($casas as $casa) {
    if ($casa->getNome() === $nomeCasaEscolhida) {
        $casaEscolhida = $casa;
        break;
    }
}

if ($casaEscolhida === null) {
    echo "Traço não corresponde a nenhuma casa válida.\n";
    exit;
}

if ($opcao === '1') {
    // Aluno Hogwarts escolhe o ano (1-7)
    $ano = (int) input("Ano escolar (1 a 7): ");
    if ($ano < 1 || $ano > 7) {
        echo "Ano inválido. Escolha entre 1 e 7.\n";
        exit;
    }
    $idade = 10 + $ano; // idade baseada no ano

    $aluno = new AlunoHogwarts($nome, $idade, $genero, $traco, $casaEscolhida, $ano);
} elseif ($opcao === '2') {
    // Aluno Novo fixo no 1º ano e 11 anos
    $ano = 1;
    $idade = 11;

    // Criar a instância do aluno novo
    $aluno = new AlunoNovo($nome, $idade, $genero, $casaEscolhida, $ano, $traco);

    // Criar a carta
    $carta = new Carta($nome, $idade, $genero);
    $carta->enviarCarta();
    $carta->receberCarta();
    $carta->confirmarRecebimento();

    // Associar a carta ao aluno
    $aluno->receberCarta($carta);

    // Perguntar se deseja aceitar
    $resposta = strtolower(input("Deseja aceitar a carta de Hogwarts? (s/n): "));
    if ($resposta === 's') {
        $aluno->aceitarCarta();
    }
}

echo "\n--- RESUMO ---\n";
echo $aluno->getResumo() . "\n";
