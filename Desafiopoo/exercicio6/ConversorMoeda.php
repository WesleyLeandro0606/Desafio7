<?php

class ConversorMoeda {

    private float $valorReais;
    private string $moedaDestino;
    private float $cotacao;

    public function __construct($valorReais, $moedaDestino, $cotacao) {
        $this->valorReais   = $valorReais;
        $this->moedaDestino = $moedaDestino;
        $this->cotacao      = $cotacao;
    }

    public function converter(): float {
        return $this->valorReais / $this->cotacao;
    }

    public function getSimbolo(): string {
        return match($this->moedaDestino) {
            'USD' => 'US$',
            'EUR' => '€',
            default => $this->moedaDestino,
        };
    }

    public function getMoedaDestino(): string { return $this->moedaDestino; }
    public function getValorReais(): float { return $this->valorReais; }
    public function getCotacao(): float { return $this->cotacao; }
}