<?php require_once 'ConversorMoeda.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moeda</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>

    <h2>Conversor de Moeda</h2>

    <form method="post">
        <label>Valor em Reais (R$):
            <input type="number" step="0.01" name="valor" value="<?= htmlspecialchars($_POST['valor'] ?? '') ?>" required>
        </label>
        <label>Moeda destino:
            <select name="moeda">
                <option value="USD" <?= (($_POST['moeda'] ?? '') === 'USD') ? 'selected' : '' ?>>Dólar (USD)</option>
                <option value="EUR" <?= (($_POST['moeda'] ?? '') === 'EUR') ? 'selected' : '' ?>>Euro (EUR)</option>
            </select>
        </label>
        <label>Cotação atual (R$ por 1 unidade):
            <input type="number" step="0.01" name="cotacao" value="<?= htmlspecialchars($_POST['cotacao'] ?? '') ?>" required>
        </label>
        <button type="submit">Converter</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conversor = new ConversorMoeda(
            (float) $_POST['valor'],
            $_POST['moeda'],
            (float) $_POST['cotacao']
        );

        echo "<div class='resultado'>";
        echo "<p>Valor em reais: R$ " . number_format($conversor->getValorReais(), 2, ',', '.') . "</p>";
        echo "<p>Cotação: R$ " . number_format($conversor->getCotacao(), 2, ',', '.') . " por 1 " . $conversor->getMoedaDestino() . "</p>";
        echo "<p class='convertido'>= " . $conversor->getSimbolo() . " " . number_format($conversor->converter(), 2, '.', ',') . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>