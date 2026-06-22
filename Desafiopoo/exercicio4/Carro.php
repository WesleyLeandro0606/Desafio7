<?php

class Carro {

    private string $modelo;
    private string $combustivel;
    private float $tanque;
    private float $consumo;
    private float $kmRodados;

    public function __construct($modelo, $combustivel, $tanque, $consumo, $kmRodados) {
        $this->modelo      = $modelo;
        $this->combustivel = $combustivel;
        $this->tanque      = $tanque;
        $this->consumo     = $consumo;
        $this->kmRodados   = $kmRodados;
    }

    public function calcularAutonomia(): float {
        return $this->tanque * $this->consumo;
    }

    public function calcularCustoPorKm(): float {
        $preco = $this->combustivel === 'etanol' ? 3.50 : 5.80;
        return $preco / $this->consumo;
    }

    public function verificarRevisao(): string {
        if ($this->kmRodados >= 10000) {
            return "Revisão necessária! ({$this->kmRodados} km rodados)";
        }
        $restante = 10000 - $this->kmRodados;
        return "Revisão em {$restante} km.";
    }

    public function getModelo(): string { return $this->modelo; }
    public function getCombustivel(): string { return $this->combustivel; }
}