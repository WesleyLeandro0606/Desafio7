<?php

class Produto {

    private string $nome;
    private int $quantidade;
    private float $valorUnitario;

    public function __construct($nome, $quantidade, $valorUnitario) {
        $this->nome          = $nome;
        $this->quantidade    = $quantidade;
        $this->valorUnitario = $valorUnitario;
    }

    public function entrada(int $qtd): void {
        $this->quantidade += $qtd;
    }

    public function saida(int $qtd): string {
        if ($qtd > $this->quantidade) {
            return "Estoque insuficiente! Disponível: {$this->quantidade}";
        }
        $this->quantidade -= $qtd;
        return "Saída realizada. Estoque atual: {$this->quantidade}";
    }

    public function getValorTotalEstoque(): float {
        return $this->quantidade * $this->valorUnitario;
    }

    public function getNome(): string { return $this->nome; }
    public function getQuantidade(): int { return $this->quantidade; }
    public function getValorUnitario(): float { return $this->valorUnitario; }
}