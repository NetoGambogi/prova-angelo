<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\Aluno;
use App\Academico\Casa;
use App\Academico\Disciplina;
use App\Academico\Professor;
use App\Service\ControleAcademicoService;
use App\Service\ControleDisciplinarService;
use App\Service\ConsultaBoletimService;
use App\Shared\Event\Bonus;
use App\Shared\Event\NotificadorTerminal;
use App\Shared\Event\Penalidade;

/**
 * Exibe um menu de opções e retorna o item selecionado pelo usuário.
 *
 * @param string $prompt O texto a ser exibido para o usuário (ex: "Escolha um aluno").
 * @param array $opcoes O array de opções a ser exibido.
 * @return mixed O item do array que foi selecionado.
 */
function selecionarOpcao(string $prompt, array $opcoes): mixed
{

    if (empty($opcoes)) {
        echo "Nenhuma opção disponível." . PHP_EOL;
        return null;
    }

    echo $prompt . PHP_EOL;
    foreach ($opcoes as $indice => $opcao) {

        $nomeExibicao = '';
        if (is_object($opcao)) {
            $nomeExibicao = method_exists($opcao, 'getNome') ? $opcao->getNome() : $opcao->value;
        } else {
            $nomeExibicao = $opcao;
        }


        echo "  [" . ($indice + 1) . "] " . $nomeExibicao . PHP_EOL;
    }

    while (true) {
        $escolha = readline("> ");
        // Verifica se é um número e se está dentro do intervalo de opções válidas
        if (ctype_digit($escolha) && isset($opcoes[$escolha - 1])) {
            return $opcoes[$escolha - 1];
        }
        echo "Opção inválida. Tente novamente." . PHP_EOL;
    }
}

// --- PREPARAÇÃO DO AMBIENTE (Dados iniciais de Hogwarts) ---

// 1. Configurar o notificador e os serviços (injeção de dependência)

$notificador = new NotificadorTerminal();
$academicoService = new ControleAcademicoService($notificador);
$disciplinarService = new ControleDisciplinarService($notificador);
$boletimService = new ConsultaBoletimService($notificador);

// 2. Criar dados iniciais

$casas = [
    new Casa('Grifinória'),
    new Casa('Sonserina'),
    new Casa('Corvinal'),
    new Casa('Lufa-Lufa')
];

$professores = [
    new Professor("Severo Snape", 38, "Masculino"),
    new Professor("Pomona Sprout", 55, "Feminino"),
    new Professor("Minerva McGonagall", 65, "Feminino")
];

$disciplinas = [
    new Disciplina("Poções", $professores[0]),
    new Disciplina("Herbologia", $professores[1]),
    new Disciplina("Transfiguração", $professores[2])
];

// Usamos os objetos do array $casas para criar os alunos
$alunos = [
    new Aluno("Harry Potter", 11, "Masculino", $casas[0], 1),     // Grifinória
    new Aluno("Hermione Granger", 11, "Feminino", $casas[0], 1),  // Grifinória
    new Aluno("Draco Malfoy", 11, "Masculino", $casas[1], 1),     // Sonserina
    new Aluno("Luna Lovegood", 11, "Feminino", $casas[2], 1),     // Corvinal
];


// --- LOOP PRINCIPAL DA APLICAÇÃO ---

while (true) {
    echo PHP_EOL . "==========================================" . PHP_EOL;
    echo "  SISTEMA DE CONTROLE DE HOGWARTS" . PHP_EOL;
    echo "==========================================" . PHP_EOL;
    echo "[1] Registrar nota de aluno" . PHP_EOL;
    echo "[2] Aplicar ação disciplinar nas casas (Pontos)" . PHP_EOL;
    echo "[3] Consultar boletim de aluno" . PHP_EOL;
    echo "[4] Exibir pontuação da copa das casas" . PHP_EOL;
    echo "[0] Sair do sistema" . PHP_EOL;
    echo "------------------------------------------" . PHP_EOL;

    $opcaoMenu = readline("Escolha uma opção: ");

    switch ($opcaoMenu) {
        case '1':
            echo PHP_EOL . "--- Registrar Nota ---" . PHP_EOL;

            // 1. O fluxo começa normalmente, escolhendo o professor.
            $professorEscolhido = selecionarOpcao("Escolha o professor que está lançando a nota:", $professores);

            // 2. Pegamos a lista de disciplinas APENAS deste professor.
            $disciplinasDoProfessor = $professorEscolhido->getDisciplinasLecionadas();

            // 3. Validação de usabilidade: e se o professor não leciona nada?
            if (empty($disciplinasDoProfessor)) {
                $notificador->notificar("AVISO: O(A) professor(a) {$professorEscolhido->getNome()} não leciona nenhuma disciplina.");
                break; // Interrompe a operação e volta ao menu principal.
            }

            // 4. Agora, oferecemos ao usuário a lista JÁ FILTRADA de disciplinas.
            $disciplinaEscolhida = selecionarOpcao("Escolha a disciplina:", $disciplinasDoProfessor);

            // 5. O resto do fluxo continua como antes.
            $alunoEscolhido = selecionarOpcao("Escolha o aluno:", $alunos);

            echo "Digite a nota (ex: 8.5): ";
            $notaValor = (float) trim(fgets(STDIN));

            try {
                // A chamada ao serviço agora é praticamente à prova de erros (neste quesito),
                // pois o usuário só pôde escolher uma disciplina válida.
                $academicoService->registrarNota($professorEscolhido, $alunoEscolhido, $disciplinaEscolhida, $notaValor);
            } catch (Exception $e) {
                $notificador->notificar("ERRO: " . $e->getMessage());
            }
            break;

        case '2':
            echo PHP_EOL . "--- Aplicar Ação Disciplinar ---" . PHP_EOL;
            $tipoAcao = selecionarOpcao("Escolha o tipo de ação:", ['Bônus', 'Penalidade']);
            $casaEscolhida = selecionarOpcao("Escolha a casa:", $casas);
            $pontos = (int) readline("Digite a quantidade de pontos: ");
            $motivo = readline("Digite o motivo: ");

            $acao = ($tipoAcao === 'Bônus')
                ? new Bonus($pontos, $motivo)
                : new Penalidade($pontos, $motivo);

            $disciplinarService->aplicarAcao($acao, $casaEscolhida);
            break;

        case '3':
            echo PHP_EOL . "--- Consultar Boletim ---" . PHP_EOL;
            $aluno = selecionarOpcao("Escolha o aluno para ver o boletim:", $alunos);
            $boletimService->consultar($aluno);
            break;

        case '4':
            echo PHP_EOL . "--- Copa das Casas ---" . PHP_EOL;
            $disciplinarService->exibirPontuacaoDasCasas();
            break;

        case '0':
            echo "Até logo, Diretor!" . PHP_EOL;
            exit; // Sai do loop e encerra o script

        default:
            echo "Opção inválida. Por favor, tente novamente." . PHP_EOL;
            break;
    }

    echo PHP_EOL . "Pressione ENTER para voltar ao menu...";
    fgets(STDIN); // Pausa a execução até o usuário pressionar Enter
}