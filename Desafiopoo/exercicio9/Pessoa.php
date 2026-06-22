<?php

class Pessoa {

    private string $nome;
    private float $peso;
    private float $altura;

    public function __construct($nome, $peso, $altura) {
        $this->nome   = $nome;
        $this->peso   = $peso;
        $this->altura = $altura;
    }

    public function calcularIMC(): float {
        return $this->peso / ($this->altura ** 2);
    }

    public function classificarIMC(): string {
        $imc = $this->calcularIMC();

        if ($imc < 18.5)      return "Abaixo do peso";
        elseif ($imc < 25.0)  return "Peso normal";
        elseif ($imc < 30.0)  return "Sobrepeso";
        else                  return "Obesidade";
    }

    public function getNome(): string { return $this->nome; }
}