<?php
declare (strict_types=1);
// Rhuan
use App\Model\Academico\AlunoHogwarts;
class Casa {
    public string $nome;
    public string $caracteristica;
    public string $professor_responsavel;
    public array $alunos = [];

    public function __construct(string $nome, string $caracteristica, string $professor_responsavel) {
        $this->nome = $nome;
        $this->caracteristica = strtolower($caracteristica);
        $this->professor_responsavel = $professor_responsavel;
    }

    public function adicionarAluno(AlunoHogwarts $aluno) {
        $this->alunos[] = $aluno;
    }

    public function getQuantidadeAlunos() {
        return count($this->alunos);
    }

    public function getPontosTotais() {
        $total = 0;
        foreach ($this->alunos as $aluno) {
            $total += $aluno->pontos;
        }
        return $total;
    }

    public function exibirInformacoes() {
        echo "Casa: {$this->nome}\n";
        echo "Características: {$this->caracteristica}\n";
        echo "Professor Responsável: {$this->professor_responsavel}\n";
        echo "Quantidade de Alunos: " . $this->getQuantidadeAlunos() . "\n";
        echo "Pontos Totais: " . $this->getPontosTotais() . "\n";
        echo "Alunos:\n";
        foreach ($this->alunos as $aluno) {
            echo "- {$aluno->nome} ({$aluno->pontos} pontos, {$aluno->caracteristica})\n";
        }
        echo "\n";
    }

    // Método estático que escolhe casa pelo traço do aluno
    public static function escolherCasaPorTraco(string $traco): string
    {
        $traco = strtolower($traco);

        // Mapeamento fixo traço => casa
        $mapa = [
            'coragem' => 'Grifinória',
            'lealdade' => 'Lufa-Lufa',
            'ambição' => 'Sonserina',
            'inteligência' => 'Corvinal',
        ];

        return $mapa[$traco] ?? 'Nenhuma';
    }
}