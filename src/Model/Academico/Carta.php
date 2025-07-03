<?php 


namespace App\Academico;

Class Carta 
{
    private string $nome;
    private int $idade;
    private string $genero;
    private string $meio_envio = 'coruja'; 
    private int $data_envio;
    private int $data_recebida;
    private int $data_confirmacao;
    private bool $confirmado = false;

    public function __construct (string $nome, int $idade, string $genero, string $meio_envio = 'coruja', int $data_envio = 0, int $data_recebida=0, int $data_confirmacao = 0)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->genero = $genero;
        $this->meio_envio = $meio_envio;
        $this->data_envio = $data_envio;
        $this->data_recebida = $data_recebida;
        $this->data_confirmacao = $data_confirmacao;
    }

    public function getNome(): string {
    
        return $this->nome;
    }
    
    public function getIdade(): int {
        return $this->idade;
    }

    public function getGenero() : string {
        return $this->genero;
    }

    public function getMeioEnvio(): string {
        return $this->meio_envio;
    }

    public function getData_envio(): int {
        return $this->data_envio;
    }

    public function getData_recebida(): int {
        return $this->data_recebida;
    }

    public function getDataConfirmacao(): int {
        return $this->data_confirmacao;
    }

    public function isConfirmado() : bool {
        return $this->confirmado;
    }

    public function setNome(string $nome): void  {
        $this->nome = $nome;
    }

    public function setIdade(int $idade): void {
        $this->idade = $idade;
    }

    public function setGenero(string $genero): void {
        $this->genero = $genero;
    }

    public function setMeioEnvio(string $meio_envio): void {
        $this->meio_envio = $meio_envio;
    }

    public function setData_envio(int $data_envio): void {
        $this->data_envio = $data_envio;
    }

    public function setDataRecebida(int $data_recebida): void {
        $this->data_recebida = $data_recebida;
    }

    public function setDataConfirmacao(int $data_confirmacao): void {
        $this->data_confirmacao = $data_confirmacao;
    }

    public function setConfirmado (bool $confirmado) : void {
        $this ->confirmado = $confirmado;
    }

    private function gerarTextoCarta():string {
        
        return "Prezado(a) {$this->nome},\n\n" .
             "Temos o prazer de informar que voce foi pre-selecionando(a) para ingressar na Escola de Magia e Bruxaria de Hogwarts.n" .
             "Favor embarcar no Expresso de Hogwarts no setor 5 no dia 20 de Janeiro.\n\n" . 
             "Atenciosamente, \n" . 
             "Diretor Alvo Dumbledore"; 
    }


    public function enviarCarta() : void {

        $this->data_envio = time();
            echo "A carta foi enviada por {$this->meio_envio} para {$this->nome} em ".date('d/m/Y H:i:s', $this->data_envio).".\n";
            echo "\n" . $this->gerarTextoCarta() . "\n"; 
            
    }

        public function receberCarta(): void 
    {
        $this->data_recebida = time();
        echo "Carta recebida por {$this->nome} em " . date('d/m/Y H:i:s', $this->data_recebida) . ".\n";
    }


    public function confirmarRecebimento(): void {
        $this->data_confirmacao = time ();
        $this->confirmado = true;
        echo "Recebimento confirmado em " . date ('d/m/Y H:i:s', $this->data_confirmacao). ".\n";

    }

}

