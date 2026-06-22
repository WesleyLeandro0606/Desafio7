<?php require_once 'Pedido.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Pedido</h2>

    <form method="post">
        <label>Produto:
            <input type="text" name="produto" value="<?= htmlspecialchars($_POST['produto'] ?? '') ?>" required>
        </label>
        <label>Quantidade:
            <input type="number" name="quantidade" min="1" value="<?= htmlspecialchars($_POST['quantidade'] ?? '') ?>" required>
        </label>
        <label>Preço Unitário (R$):
            <input type="number" step="0.01" min="0" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required>
        </label>
        <label>Tipo de Cliente:
            <select name="tipo">
                <option value="normal"   <?= (($_POST['tipo'] ?? '') === 'normal')   ? 'selected' : '' ?>>Normal</option>
                <option value="premium"  <?= (($_POST['tipo'] ?? '') === 'premium')  ? 'selected' : '' ?>>Premium</option>
            </select>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pedido = new Pedido(
            $_POST['produto'],
            (int)   $_POST['quantidade'],
            (float) $_POST['preco'],
            $_POST['tipo']
        );

        echo "<div class='resultado'>";
        echo "<p>Produto: <strong>" . htmlspecialchars($pedido->getProduto()) . "</strong></p>";
        echo "<p>Cliente: <strong>" . htmlspecialchars($pedido->getTipoCliente()) . "</strong></p>";
        echo "<p>Total bruto: R$ " . number_format($pedido->calcularTotalBruto(), 2, ',', '.') . "</p>";
        echo "<p>Desconto (10% premium): R$ " . number_format($pedido->calcularDesconto(), 2, ',', '.') . "</p>";
        echo "<p>Imposto (8%): R$ " . number_format($pedido->calcularImposto(), 2, ',', '.') . "</p>";
        echo "<p class='total'>Total final: R$ " . number_format($pedido->calcularTotalFinal(), 2, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>