<?php

class ReservaHotel {

    private string $hospede;
    private int $noites;
    private string $tipoQuarto;

    private array $precos = [
        'simples' => 120.0,
        'luxo'    => 200.0,
        'suite'   => 350.0,
    ];

    public function __construct($hospede, $noites, $tipoQuarto) {
        $this->hospede    = $hospede;
        $this->noites     = $noites;
        $this->tipoQuarto = $tipoQuarto;
    }

    private function getPrecoDiaria(): float {
        return $this->precos[$this->tipoQuarto] ?? 0.0;
    }

    public function calcularTotal(): float {
        return $this->getPrecoDiaria() * $this->noites;
    }

    public function calcularDesconto(): float {
        if ($this->noites > 5) {
            return $this->calcularTotal() * 0.10;
        }
        return 0.0;
    }

    public function calcularTotalFinal(): float {
        return $this->calcularTotal() - $this->calcularDesconto();
    }

    public function getMensagemBoasVindas(): string {
        return "Bem-vindo(a), {$this->hospede}! Sua reserva de {$this->noites} noite(s) no quarto {$this->tipoQuarto} está confirmada.";
    }

    public function getHospede(): string { return $this->hospede; }
    public function getNoites(): int { return $this->noites; }
    public function getTipoQuarto(): string { return $this->tipoQuarto; }
}