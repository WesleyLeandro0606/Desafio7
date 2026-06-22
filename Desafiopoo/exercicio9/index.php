<?php require_once 'Pessoa.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Calculadora de IMC</h2>

    <form method="post">
        <label>Nome:
            <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
        </label>
        <label>Peso (kg):
            <input type="number" step="0.1" name="peso" value="<?= htmlspecialchars($_POST['peso'] ?? '') ?>" required>
        </label>
        <label>Altura (m):
            <input type="number" step="0.01" name="altura" value="<?= htmlspecialchars($_POST['altura'] ?? '') ?>" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pessoa = new Pessoa(
            $_POST['nome'],
            (float) $_POST['peso'],
            (float) $_POST['altura']
        );

        $classificacao = $pessoa->classificarIMC();
        $classe = match($classificacao) {
            'Peso normal'     => 'normal',
            'Sobrepeso'       => 'atencao',
            default           => 'alerta',
        };

        echo "<div class='resultado'>";
        echo "<p>Olá, <strong>" . htmlspecialchars($pessoa->getNome()) . "</strong>!</p>";
        echo "<p class='imc-valor'>IMC: " . number_format($pessoa->calcularIMC(), 2, ',', '.') . "</p>";
        echo "<p class='{$classe}'>Classificação: <strong>{$classificacao}</strong></p>";
        echo "</div>";
    }
    ?>

</body>
</html>