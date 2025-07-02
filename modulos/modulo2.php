<?php

require_once __DIR__ . '/../src/Model/Academico/AlunoHogwarts.php';
require_once __DIR__ . '/../src/Model/Academico/AlunoNovo.php';
require_once __DIR__ . '/../src/Model/Academico/Casa.php';

use App\Academico\AlunoHogwarts;
use App\Academico\AlunoNovo;
use App\Academico\Casa;

// Função que mapeia características para casas
function determinarCasa(string $caracteristica): string {
    return match (strtolower($caracteristica)) {
        'coragem' => 'Grifinória',
        'ambição' => 'Sonserina',
        'lealdade' => 'Lufa-Lufa',
        'inteligência' => 'Corvinal',
        default => 'Indefinido'
    };
}

// Entrada de dados
$tipoAluno = readline("Você é um novo aluno ou já estuda em Hogwarts? (novo/existente): ");

if (strtolower($tipoAluno) === 'novo') {
    $nome = readline("Digite seu nome: ");
    $idade = (int)readline("Digite sua idade: ");
    $genero = readline("Digite seu gênero: ");
    $caracteristica = readline("Escolha sua principal característica (Coragem, Ambição, Lealdade, Inteligência): ");
    $casaNome = determinarCasa($caracteristica);

    if ($casaNome === 'Indefinido') {
        echo "Característica inválida! Tente novamente.";
        exit;
    }

    $ano = (int)readline("Digite o ano do aluno: ");
    $casa = new Casa($casaNome);

    $aluno = new AlunoNovo($nome, $idade, $genero, $casa, $ano, $caracteristica);

    echo "Parabéns, $nome! Você foi selecionado para a casa $casaNome!" . PHP_EOL;


}


elseif (strtolower($tipoAluno) === 'existente') {
    $nome = readline("Digite seu nome: ");
    $idade = (int)readline("Digite sua idade: ");
    $genero = readline("Digite seu gênero: ");
    $casaNome = readline("Qual é a sua casa? ");
    $ano = (int)readline("Digite o ano do aluno: ");
    $traco = readline("Qual seu principal traço? (Coragem, Ambição, Lealdade, Inteligência): ");

    $casa = new Casa($casaNome);

$aluno = new AlunoHogwarts($nome, $idade, $genero, $traco, $casa, $ano);

    echo "Bem-vindo de volta, $nome da casa $casaNome!" . PHP_EOL;
}
