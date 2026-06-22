<?php require_once 'CalculadoraFinanceira.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Financeira</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Calculadora de Parcelamento</h2>

    <form method="post">
        <label>Valor da compra (R$):
            <input type="number" step="0.01" name="valor" value="<?= htmlspecialchars($_POST['valor'] ?? '') ?>" required>
        </label>
        <label>Número de parcelas:
            <input type="number" min="1" name="parcelas" value="<?= htmlspecialchars($_POST['parcelas'] ?? '') ?>" required>
        </label>
        <label>Taxa de juros mensal (%):
            <input type="number" step="0.01" name="juros" value="<?= htmlspecialchars($_POST['juros'] ?? '') ?>" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $calc = new CalculadoraFinanceira(
            (float) $_POST['valor'],
            (int)   $_POST['parcelas'],
            (float) $_POST['juros']
        );

        echo "<div class='resultado'>";
        echo "<p>Valor original: R$ " . number_format($calc->getValor(), 2, ',', '.') . "</p>";
        echo "<p class='parcela'>" . $calc->getParcelas() . "x de R$ " . number_format($calc->calcularParcela(), 2, ',', '.') . "</p>";
        echo "<p>Total a pagar: R$ " . number_format($calc->calcularTotalPagar(), 2, ',', '.') . "</p>";
        echo "<p class='juros'>Juros pagos: R$ " . number_format($calc->calcularJurosPagos(), 2, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>