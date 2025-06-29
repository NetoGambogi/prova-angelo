<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Academico\Aluno;
use App\Academico\Casa;
use App\Academico\Disciplina;
use App\Academico\Professor;
use App\Academico\Turma;
use App\Academico\AtividadeExtra;

/**
 * Exibe um menu de opções e retorna o item selecionado pelo usuário.
 */
function selecionarOpcao(string $prompt, array $opcoes, bool $permiteNenhum = false): mixed
{
    if (empty($opcoes)) {
        echo "Nenhuma opção disponível." . PHP_EOL;
        return null;
    }

    echo $prompt . PHP_EOL;
    foreach ($opcoes as $indice => $opcao) {
        $nomeExibicao = is_object($opcao) && method_exists($opcao, 'getNome') ? $opcao->getNome() : (string)$opcao;
        echo "  [" . ($indice + 1) . "] " . $nomeExibicao . PHP_EOL;
    }
    if ($permiteNenhum) {
        echo "  [0] Concluir seleção" . PHP_EOL;
    }

    while (true) {
        $escolha = readline("> ");
        if ($permiteNenhum && $escolha === '0') {
            return null;
        }
        if (ctype_digit($escolha) && isset($opcoes[$escolha - 1])) {
            return $opcoes[$escolha - 1];
        }
        echo "Opção inválida. Tente novamente." . PHP_EOL;
    }
}

// --- PREPARAÇÃO DO AMBIENTE (Dados iniciais de Hogwarts) ---

$casas = [
    new Casa('Grifinória'), new Casa('Sonserina'), new Casa('Corvinal'), new Casa('Lufa-Lufa')
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

$alunos = [
    new Aluno("Harry Potter", 11, "Masculino", $casas[0], 1),
    new Aluno("Hermione Granger", 11, "Feminino", $casas[0], 1),
    new Aluno("Draco Malfoy", 11, "Masculino", $casas[1], 1),
    new Aluno("Luna Lovegood", 11, "Feminino", $casas[2], 1),
];

$turmas = [];
$atividadesExtras = [];

// --- LOOP PRINCIPAL DO MÓDULO ---

while (true) {
    echo PHP_EOL . "======================================================" . PHP_EOL;
    echo "  Gerenciamento de Professores e Funcionários" . PHP_EOL;
    echo "======================================================" . PHP_EOL;
    echo "[1] Cadastrar Novo Professor" . PHP_EOL;
    echo "[2] Criar Nova Turma e Associar Alunos" . PHP_EOL;
    echo "[3] Registrar Atividade Extra para Professor" . PHP_EOL;
    echo "[4] Consultar Cronograma de um Professor" . PHP_EOL;
    echo "[0] Voltar ao Menu Principal" . PHP_EOL;
    echo "------------------------------------------------------" . PHP_EOL;

    $opcaoMenu = readline("Escolha uma opção: ");

    switch ($opcaoMenu) {
        case '1':
            echo PHP_EOL . "--- Cadastrar Novo Professor ---" . PHP_EOL;
            $nome = readline("Nome do professor: ");
            $idade = (int)readline("Idade: ");
            $genero = readline("Gênero: ");
            $novoProfessor = new Professor($nome, $idade, $genero);
            $professores[] = $novoProfessor;
            echo "✅ Professor(a) {$nome} cadastrado com sucesso!" . PHP_EOL;
            break;

        case '2':
            echo PHP_EOL . "--- Criar Nova Turma ---" . PHP_EOL;
            $disciplinaEscolhida = selecionarOpcao("Escolha a disciplina para a nova turma:", $disciplinas);
            if (!$disciplinaEscolhida) break;

            $professorDaDisciplina = $disciplinaEscolhida->getProfessor();
            echo "Professor(a) da disciplina: {$professorDaDisciplina->getNome()}" . PHP_EOL;
            
            $nomeTurma = readline("Nome da turma (ex: Transfiguração - Ano 1): ");
            $horario = readline("Horário da turma (ex: Segundas, 10h-12h): ");

            try {
                $novaTurma = new Turma($nomeTurma, $disciplinaEscolhida, $professorDaDisciplina, $horario);
                $professorDaDisciplina->adicionarTurma($novaTurma);
                
                echo "--- Adicionar Alunos à Turma ---" . PHP_EOL;
                while($alunoParaAdicionar = selecionarOpcao("Selecione um aluno para adicionar (ou 0 para concluir):", $alunos, true)) {
                    $novaTurma->adicionarAluno($alunoParaAdicionar);
                    echo "-> {$alunoParaAdicionar->getNome()} adicionado(a)." . PHP_EOL;
                }

                $turmas[] = $novaTurma;
                echo "✅ Turma '{$nomeTurma}' criada e associada ao professor(a) {$professorDaDisciplina->getNome()}." . PHP_EOL;

            } catch (Exception $e) {
                echo "ERRO: " . $e->getMessage() . PHP_EOL;
            }
            break;

        case '3':
            echo PHP_EOL . "--- Registrar Atividade Extra ---" . PHP_EOL;
            $professorEscolhido = selecionarOpcao("Escolha o professor responsável:", $professores);
            if (!$professorEscolhido) break;
            
            $nomeAtividade = readline("Nome da atividade (ex: Clube de Duelos): ");
            $descricao = readline("Breve descrição da atividade: ");
            $horarioAtividade = readline("Horário da atividade (ex: Sextas, 16h): ");

            $novaAtividade = new AtividadeExtra($nomeAtividade, $descricao, $professorEscolhido, $horarioAtividade);
            $professorEscolhido->adicionarAtividadeExtra($novaAtividade);
            $atividadesExtras[] = $novaAtividade;
            
            echo "✅ Atividade '{$nomeAtividade}' registrada para o(a) professor(a) {$professorEscolhido->getNome()}." . PHP_EOL;
            break;

        case '4':
            echo PHP_EOL . "--- Consultar Cronograma do Professor ---" . PHP_EOL;
            $professorEscolhido = selecionarOpcao("Escolha um professor para ver o cronograma:", $professores);
            if (!$professorEscolhido) break;

            echo "===============================================" . PHP_EOL;
            echo "📅 Cronograma de: " . strtoupper($professorEscolhido->getNome()) . PHP_EOL;
            echo "===============================================" . PHP_EOL;

            echo "AULAS REGULARES:" . PHP_EOL;
            $turmasDoProfessor = $professorEscolhido->getTurmas();
            if (empty($turmasDoProfessor)) {
                echo "  Nenhuma turma regular encontrada." . PHP_EOL;
            } else {
                foreach ($turmasDoProfessor as $turma) {
                    echo "  - [Turma] {$turma->getNome()} ({$turma->getDisciplina()->getNome()})" . PHP_EOL;
                    echo "    Horário: {$turma->getHorario()}" . PHP_EOL;
                    echo "    Alunos: " . count($turma->getAlunos()) . PHP_EOL;
                }
            }

            echo PHP_EOL . "ATIVIDADES EXTRAS COORDENADAS:" . PHP_EOL;
            $atividadesDoProfessor = $professorEscolhido->getAtividadesExtras();
            if (empty($atividadesDoProfessor)) {
                echo "  Nenhuma atividade extra encontrada." . PHP_EOL;
            } else {
                foreach ($atividadesDoProfessor as $atividade) {
                    echo "  - [Atividade] {$atividade->getNome()}" . PHP_EOL;
                    echo "    Horário: {$atividade->getHorario()}" . PHP_EOL;
                }
            }
            echo "===============================================" . PHP_EOL;
            break;

        case '0':
            echo "Retornando ao menu principal..." . PHP_EOL;
            return; // Sai do script do módulo e volta para app.php

        default:
            echo "Opção inválida. Por favor, tente novamente." . PHP_EOL;
            break;
    }

    echo PHP_EOL . "Pressione ENTER para voltar ao menu do módulo...";
    fgets(STDIN);
}