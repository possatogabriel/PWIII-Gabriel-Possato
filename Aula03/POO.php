<?php
echo "<h1> Programação Orientada a Objetos </h1>";

// Classe Pessoa
class Pessoa {
    // Atributos de uma pessoa
    protected $nome;
    protected $idade;

    public function __construct($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function verificaMaioridade() {
        if ($this-> idade >= 18) {
            return "sou maior de idade!";
        } else {
            return "sou menor de idade!";
        }   
    }

    // Funções de uma pessoa
    public function seApresenta() {
        echo $this-> nome .": Olá! Meu nome é ". $this-> nome ." e eu tenho ". $this-> idade .", ou seja, ". $this-> verificaMaioridade() ."</br> ";
    }
}

class Trabalhador extends Pessoa {
    private $trabalho;

    #[Override]
    public function __construct($nome, $idade, $trabalho) {
        $this-> nome = $nome;
        $this-> idade = $idade;
        $this-> trabalho = $trabalho;
    }

    public function getTrabalho() {
        return $this-> trabalho;
    }

    // Funções de uma pessoa trabalhadora
    #[Override]
    public function seApresenta() {
        echo "</br> ". $this-> nome .": Olá! Meu nome é ". $this-> nome ." e eu tenho ". $this-> idade .", ou seja, ". $this-> verificaMaioridade() ." Além disso, trabalho como: ". $this-> trabalho ."! </br>";
    }
}

$pessoa1 = new Pessoa("Gabriel", 23);
$pessoa1 -> seApresenta();

$pessoa2 = new Pessoa("Possato", 17);
$pessoa2 -> seApresenta();

$trabalhador1 = new Trabalhador("Alves", 25, "Programador");
$trabalhador1 -> seApresenta();

?>