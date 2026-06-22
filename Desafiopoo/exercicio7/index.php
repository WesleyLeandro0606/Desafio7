<?php require_once 'Viagem.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planejamento de Viagem</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>

    <h2>Planejamento de Viagem</h2>

    <form method="post">
        <label>Origem:
            <input type="text" name="origem" value="<?= htmlspecialchars($_POST['origem'] ?? '') ?>" required>
        </label>
        <label>Destino:
            <input type="text" name="destino" value="<?= htmlspecialchars($_POST['destino'] ?? '') ?>" required>
        </label>
        <label>Distância (km):
            <input type="number" step="0.1" name="distancia" value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
        </label>
        <label>Tempo estimado (horas):
            <input type="number" step="0.1" name="tempo" value="<?= htmlspecialchars($_POST['tempo'] ?? '') ?>" required>
        </label>
        <label>Tipo de veículo:
            <select name="veiculo">
                <option value="carro"    <?= (($_POST['veiculo'] ?? '') === 'carro')    ? 'selected' : '' ?>>Carro (12 km/l)</option>
                <option value="moto"     <?= (($_POST['veiculo'] ?? '') === 'moto')     ? 'selected' : '' ?>>Moto (20 km/l)</option>
                <option value="caminhao" <?= (($_POST['veiculo'] ?? '') === 'caminhao') ? 'selected' : '' ?>>Caminhão (5 km/l)</option>
            </select>
        </label>
        <label>Preço do combustível (R$/L):
            <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $viagem = new Viagem(
            $_POST['origem'],
            $_POST['destino'],
            (float) $_POST['distancia'],
            (float) $_POST['tempo'],
            $_POST['veiculo'],
            (float) $_POST['preco']
        );

        echo "<div class='resultado'>";
        echo "<p>Rota: <strong>" . htmlspecialchars($viagem->getOrigem()) . " → " . htmlspecialchars($viagem->getDestino()) . "</strong></p>";
        echo "<p>Veículo: " . htmlspecialchars($viagem->getVeiculo()) . "</p>";
        echo "<p>Velocidade média: " . number_format($viagem->calcularVelocidadeMedia(), 1, ',', '.') . " km/h</p>";
        echo "<p>Consumo estimado: " . number_format($viagem->calcularConsumoEstimado(), 2, ',', '.') . " litros</p>";
        echo "<p class='destaque'>Custo da viagem: R$ " . number_format($viagem->calcularCustoViagem(), 2, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>