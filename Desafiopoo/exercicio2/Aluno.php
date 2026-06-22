<?php

class Aluno {

    private string $nome;
    private string $disciplina;
    private float $nota1, $nota2, $nota3;
    private float $media;

    public function __construct($nome, $disciplina, $nota1, $nota2, $nota3) {
        $this->nome       = $nome;
        $this->disciplina = $disciplina;
        $this->nota1      = $nota1;
        $this->nota2      = $nota2;
        $this->nota3      = $nota3;
    }

    public function calcularMedia(): float {
        $this->media = ($this->nota1 + $this->nota2 + $this->nota3) / 3;
        return $this->media;
    }

    public function exibirResumo(): string {
        return "Aluno: {$this->nome}, Média: " . number_format($this->calcularMedia(), 1);
    }

    public function calcularSituacao(): string {
        $media = $this->calcularMedia();

        if ($media >= 7) {
            return "Aprovado";
        } elseif ($media >= 5) {
            return "Recuperação";
        } else {
            return "Reprovado";
        }
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDisciplina(): string {
        return $this->disciplina;
    }

}