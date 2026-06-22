<?php

class CalculadoraGeometrica {

    private string $figura;
    private float $medida1;
    private float $medida2;

    public function __construct($figura, $medida1, $medida2 = 0) {
        $this->figura  = $figura;
        $this->medida1 = $medida1;
        $this->medida2 = $medida2;
    }

    public function calcularArea(): float {
        return match($this->figura) {
            'quadrado'   => $this->medida1 ** 2,
            'retangulo'  => $this->medida1 * $this->medida2,
            'circulo'    => M_PI * ($this->medida1 ** 2),
            default      => 0.0,
        };
    }

    public function getFigura(): string { return $this->figura; }
}