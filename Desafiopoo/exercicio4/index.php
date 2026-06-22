<?php require_once 'Carro.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Autonomia do Carro</h2>

    <form method="post">
        <label>Modelo:
            <input type="text" name="modelo" value="<?= htmlspecialchars($_POST['modelo'] ?? '') ?>" required>
        </label>
        <label>Combustível:
            <select name="combustivel">
                <option value="gasolina" <?= (($_POST['combustivel'] ?? '') === 'gasolina') ? 'selected' : '' ?>>Gasolina (R$ 5,80/L)</option>
                <option value="etanol"   <?= (($_POST['combustivel'] ?? '') === 'etanol')   ? 'selected' : '' ?>>Etanol (R$ 3,50/L)</option>
            </select>
        </label>
        <label>Tanque cheio (litros):
            <input type="number" step="0.1" name="tanque" value="<?= htmlspecialchars($_POST['tanque'] ?? '') ?>" required>
        </label>
        <label>Consumo (km/l):
            <input type="number" step="0.1" name="consumo" value="<?= htmlspecialchars($_POST['consumo'] ?? '') ?>" required>
        </label>
        <label>Km rodados (para revisão):
            <input type="number" name="km" value="<?= htmlspecialchars($_POST['km'] ?? '') ?>" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $carro = new Carro(
            $_POST['modelo'],
            $_POST['combustivel'],
            (float) $_POST['tanque'],
            (float) $_POST['consumo'],
            (float) $_POST['km']
        );

        $revisao = $carro->verificarRevisao();
        $classeRevisao = str_contains($revisao, 'necessária') ? 'alerta' : 'ok';

        echo "<div class='resultado'>";
        echo "<p>Modelo: <strong>" . htmlspecialchars($carro->getModelo()) . "</strong></p>";
        echo "<p>Combustível: <strong>" . htmlspecialchars($carro->getCombustivel()) . "</strong></p>";
        echo "<p>Autonomia: <strong>" . number_format($carro->calcularAutonomia(), 1, ',', '.') . " km</strong></p>";
        echo "<p>Custo por km: R$ " . number_format($carro->calcularCustoPorKm(), 2, ',', '.') . "</p>";
        echo "<p class='{$classeRevisao}'>" . $revisao . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>