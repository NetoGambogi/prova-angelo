<?php

declare(strict_types=1);

function exibirMenu(): void
{
    echo "Qual módulo você deseja executar?\n\n";
    echo "1 - Convite e Cadastro de Alunos\n";
    echo "2 - Seleção de Casas\n";
    echo "3 - Gerenciamento de Torneios e Competições\n";
    echo "4 - Controle acadêmico e Disciplinar\n";
    echo "5 - Gerenciamento de professores e funcionários\n";
    echo "6 - Sistema de alertas e comunicação\n";
    echo "\nDigite o número correspondente: ";
}

function obterEntrada(): string
{
    $handle = fopen("php://stdin", "r");
    $line = trim(fgets($handle));
    fclose($handle);
    return $line;
}

exibirMenu();

$opcao = obterEntrada();

switch ($opcao) {
    case '1':
        require_once __DIR__ . '/modulos/modulo1.php';
        break;
    case '2':
        require_once __DIR__ . '/modulos/modulo2.php';
        break;
    case '3':
        require_once __DIR__ . '/modulos/modulo3.php';
        break;
    case '4':
        require_once __DIR__ . '/modulos/modulo4.php';
        break;
    case '5':
        require_once __DIR__ . '/modulos/modulo5.php';
        break;
    case '6':
        require_once __DIR__ . '/modulos/modulo6.php';
        break;
    default:
        echo "Opção inválida. Tente novamente.\n";
}