<?php

class Viagem {

    private string $origem;
    private string $destino;
    private float $distancia;
    private float $tempo;
    private string $veiculo;
    private float $precoCombustivel;

    private array $consumos = [
        'carro'  => 12.0,
        'moto'   => 20.0,
        'caminhao' => 5.0,
    ];

    public function __construct($origem, $destino, $distancia, $tempo, $veiculo, $precoCombustivel) {
        $this->origem            = $origem;
        $this->destino           = $destino;
        $this->distancia         = $distancia;
        $this->tempo             = $tempo;
        $this->veiculo           = $veiculo;
        $this->precoCombustivel  = $precoCombustivel;
    }

    public function calcularVelocidadeMedia(): float {
        return $this->distancia / $this->tempo;
    }

    public function calcularConsumoEstimado(): float {
        $consumo = $this->consumos[$this->veiculo] ?? 10.0;
        return $this->distancia / $consumo;
    }

    public function calcularCustoViagem(): float {
        return $this->calcularConsumoEstimado() * $this->precoCombustivel;
    }

    public function getOrigem(): string { return $this->origem; }
    public function getDestino(): string { return $this->destino; }
    public function getVeiculo(): string { return $this->veiculo; }
}