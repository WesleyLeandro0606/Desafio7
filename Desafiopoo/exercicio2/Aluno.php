<?php

class Aluno {

private string $nome;
private string $disciplina;

private float $nota1, $nota2, $nota3;



public function __construct ($nome, $disciplina, $nota1, $nota2, $nota3) {
    $this->nome = $nome;
    $this->disciplina = $disciplina;
    $this->nota1 = $nota1;
    $this->nota2 = $nota2;
    $this->nota3 = $nota3;
   

}

public function getResumo(){
    return "Aluno: {$this->nome},";
}

public function calcularMedia(){
   $this->media = ($this->nota1 + $this->nota2 + $this->nota3) / 3;
    return $this->media;
}

public function exibirResumo(){
    return "Aluno: {$this->nome}, Média: " . number_format($this->calcularMedia(), 1) . ""; 
    // esse metodo retorna = Aluno= nome, media: 7.2
}

public function calcularSituacao(){
    $media = $this->calcularMedia();

    if ($media >= 7) {
        return "Aprovado";
    } elseif ($media >= 5) {
        return "Recuperação";
    } else {
        return "Reprovado";
    }
}

}

?>