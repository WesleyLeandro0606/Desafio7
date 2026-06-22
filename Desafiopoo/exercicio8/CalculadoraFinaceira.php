<?php

class CalculadoraFinanceira {

    private float $valor;
    private int $parcelas;
    private float $taxaJuros;

    public function __construct($valor, $parcelas, $taxaJuros) {
        $this->valor     = $valor;
        $this->parcelas  = $parcelas;
        $this->taxaJuros = $taxaJuros / 100;
    }

    public function calcularParcela(): float {
        // parcela = valor * (1 + juro) ^ n / n
        return ($this->valor * pow(1 + $this->taxaJuros, $this->parcelas)) / $this->parcelas;
    }

    public function calcularTotalPagar(): float {
        return $this->calcularParcela() * $this->parcelas;
    }

    public function calcularJurosPagos(): float {
        return $this->calcularTotalPagar() - $this->valor;
    }

    public function getValor(): float { return $this->valor; }
    public function getParcelas(): int { return $this->parcelas; }
}