<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

// Módulo 4 - Controle Acadêmico e Disciplinar.

use App\Academico\Aluno;
use App\Academico\Professor;
use App\Academico\Disciplina;
use App\Academico\Avaliacao;
use App\Academico\RegistroDisciplina;
use App\Academico\PontuacaoCasa;
use App\Academico\Boletim;

$profSnape = new Professor("Severo Snape", 45, "masculino");
$profSprout = new Professor("Pomona Sprout", 58, "feminino");

$pocoes = new Disciplina("Poções", $profSnape);
$herbologia = new Disciplina("Herbologia", $profSprout);

$harry = new Aluno('Harry Potter', 14, 'Masculino', 'Grifinória', 5);
$draco = new Aluno("Draco Malfoy", 16, "Masculino", "Sonserina", 5);

$avaliacao1 = new Avaliacao("Prova de Poções - 1º Bimestre", 10.0);

$profSnape->registrarNota($harry, "Poções", 8.5);
$profSprout->registrarNota($draco, "Herbologia", 6.0);

$registro = new RegistroDisciplina();
$registro->registrar($harry, "Poções", 8.5);
$registro->registrar($draco, "Herbologia", 6.0);

$pontuacao = new PontuacaoCasa();
$pontuacao->aplicarPontos("Grifinória", 10);
$pontuacao->aplicarPontos("Sonserina", -5);

$boletim = new Boletim();

echo "═══════════════════════════════════════════════════════════════\n";
echo "📘 BOLETIM GERAL – HOGWARTS ESCOLA DE MAGIA E BRUXARIA\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

foreach ([$harry, $draco] as $aluno) {
    echo "🧑 Aluno: " . $aluno->getNome() . "\n";
    echo "🏠 Casa: " . $aluno->getCasa() . "\n";
    echo "🎓 Ano: " . $aluno->getAno() . "º\n";
    echo "📅 Idade: " . $aluno->getIdade() . " anos\n";
    echo "📊 Notas:\n";

    $notas = $boletim->gerar($aluno);

    foreach ($notas as $nomeDisciplina => $listaNotas) {
        $disciplina = Disciplina::buscarPorNome($nomeDisciplina);

        $professorNome = $disciplina
            ? $disciplina->getProfessor()->getNome()
            : "Desconhecido";

        foreach ($listaNotas as $nota) {
            echo "   • {$nomeDisciplina}: {$nota}/10 (👨‍🏫 {$professorNome})\n";
        }
    }

    echo "───────────────────────────────────────────────────────────────\n";
}

echo "\n🏆 PONTUAÇÃO DAS CASAS\n";
echo "───────────────────────────────────────────────────────────────\n";

$pontuacoes = $pontuacao->getPontuacoes();

arsort($pontuacoes);

foreach ($pontuacoes as $casa => $pontos) {
    $emoji = $pontos >= 0 ? "✨" : "⚠️";
    echo " {$emoji} {$casa}: {$pontos} pontos\n";
}

echo "═══════════════════════════════════════════════════════════════\n";