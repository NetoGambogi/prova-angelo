<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\Professor;
use App\Academico\Administrador;
use App\Academico\Aluno;
use App\Academico\Casa;
use App\Academico\Mensagem;
use App\Service\ServicoDeMensagens;
use App\Shared\Event\NotificadorTerminal;

function selecionarOpcao(string $prompt, array $opcoes): mixed
{
    if (empty($opcoes)) {
        echo "Nenhuma opção disponível." . PHP_EOL;
        return null;
    }

    echo $prompt . PHP_EOL;
    foreach ($opcoes as $indice => $opcao) {
        $nomeExibicao = is_object($opcao) && method_exists($opcao, 'getNome')
            ? $opcao->getNome()
            : (is_object($opcao) && property_exists($opcao, 'value') ? $opcao->value : $opcao);
        echo "  [" . ($indice + 1) . "] " . $nomeExibicao . PHP_EOL;
    }

    while (true) {
        $escolha = readline("> ");
        if (ctype_digit($escolha) && isset($opcoes[$escolha - 1])) {
            return $opcoes[$escolha - 1];
        }
        echo "Opção inválida. Tente novamente." . PHP_EOL;
    }
}

$notificador = new NotificadorTerminal();
$servico = new ServicoDeMensagens($notificador);

// Emitentes
$professor = new Professor("Minerva McGonagall", 65, "Feminino");
$administrador = new Administrador("Alvo Dumbledore", 115, "Masculino");

// Destinatários
$alunos = [
    new Aluno("Harry Potter", 11, "Masculino", new Casa("Grifinória"), 7),
    new Aluno("Hermione Granger", 11, "Feminino", new Casa("Grifinória"), 7),
];

while (true) {
    echo PHP_EOL . "==========================================" . PHP_EOL;
    echo "  SISTEMA DE ALERTAS E COMUNICAÇÃO" . PHP_EOL;
    echo "==========================================" . PHP_EOL;
    echo "[1] Enviar notificação imediata" . PHP_EOL;
    echo "[2] Agendar aviso para depois" . PHP_EOL;
    echo "[3] Processar fila de mensagens" . PHP_EOL;
    echo "[4] Avisos escolares" . PHP_EOL;
    echo "[5] Confirmar leitura de mensagens" . PHP_EOL;
    echo "[0] Sair do sistema" . PHP_EOL;
    echo "------------------------------------------" . PHP_EOL;

    $opcaoMenu = readline("Escolha uma opção: ");

    switch ($opcaoMenu) {
        case '1':
            echo PHP_EOL . "--- Enviar Notificação Imediata ---" . PHP_EOL;
            $emissor = selecionarOpcao("Escolha o emissor:", [$professor, $administrador]);
            $mensagemTexto = readline("Digite a mensagem: ");
            $mensagem = new Mensagem(
                $mensagemTexto,
                $emissor,
                $alunos,
                new DateTime()
            );
            $servico->enviarMensagem($mensagem);
            break;

        case '2':
            echo PHP_EOL . "--- Agendar Aviso ---" . PHP_EOL;
            $emissor = selecionarOpcao("Escolha o emissor:", [$professor, $administrador]);
            $mensagemTexto = readline("Digite a mensagem a agendar: ");
            $dataHora = readline("Digite data/hora agendada (Y-m-d H:i): ");
            $dataAgendada = DateTime::createFromFormat('Y-m-d H:i', $dataHora);

            if (!$dataAgendada) {
                echo "Data/Hora inválida!" . PHP_EOL;
                break;
            }

            $mensagemAgendada = new Mensagem(
                $mensagemTexto,
                $emissor,
                $alunos,
                new DateTime(),
                $dataAgendada
            );
            $servico->enviarMensagem($mensagemAgendada);
            echo "Mensagem agendada para {$dataHora}." . PHP_EOL;
            break;

        case '3':
            echo PHP_EOL . "--- Processar Fila de Mensagens ---" . PHP_EOL;
            $servico->processarFila();
            break;

        case '4':
            echo PHP_EOL . "--- Ver Notificações Recebidas ---" . PHP_EOL;
            $mensagens = $servico->getMensagensEnviadas();

            if (empty($mensagens)) {
                echo "Nenhuma notificação recebida ainda." . PHP_EOL;
            } else {
                foreach ($mensagens as $m) {
                    echo "- [" . ($m->getStatus()) . "] " . $m->getConteudo() . PHP_EOL;
                }
            }
            break;

        case '5':
            echo PHP_EOL . "--- Confirmar Leitura ---" . PHP_EOL;
            $mensagens = $servico->getMensagensEnviadas();
            if (empty($mensagens)) {
                echo "Nenhuma mensagem para confirmar leitura." . PHP_EOL;
                break;
            }

            $mensagemParaConfirmar = selecionarOpcao("Escolha a mensagem:", $mensagens);
            $mensagemParaConfirmar->confirmarLeitura();
            echo "Leitura confirmada!" . PHP_EOL;
            break;

        case '0':
            echo "Saindo do sistema de alertas." . PHP_EOL;
            exit;

        default:
            echo "Opção inválida. Por favor, tente novamente." . PHP_EOL;
            break;
    }

    echo PHP_EOL . "Pressione ENTER para continuar...";
    fgets(STDIN);
}
