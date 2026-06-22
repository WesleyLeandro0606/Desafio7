<?php

class Pedido {

    private string $produto;
    private int $quantidade;
    private float $precoUnitario;
    private string $tipoCliente;

    public function __construct($produto, $quantidade, $precoUnitario, $tipoCliente) {
        $this->produto        = $produto;
        $this->quantidade     = $quantidade;
        $this->precoUnitario  = $precoUnitario;
        $this->tipoCliente    = $tipoCliente;
    }

    public function calcularTotalBruto(): float {
        return $this->quantidade * $this->precoUnitario;
    }

    public function calcularDesconto(): float {
        if ($this->tipoCliente === 'premium') {
            return $this->calcularTotalBruto() * 0.10;
        }
        return 0.0;
    }

    public function calcularImposto(): float {
        return $this->calcularTotalBruto() * 0.08;
    }

    public function calcularTotalFinal(): float {
        return $this->calcularTotalBruto() - $this->calcularDesconto() + $this->calcularImposto();
    }

    public function getProduto(): string { return $this->produto; }
    public function getTipoCliente(): string { return $this->tipoCliente; }
}