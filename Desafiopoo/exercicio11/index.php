<?php require_once 'CalculadoraGeometrica.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Geométrica</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Calculadora Geométrica</h2>

    <form method="post">
        <label>Figura:
            <select name="figura" id="figura" onchange="atualizarCampos()">
                <option value="quadrado"  <?= (($_POST['figura'] ?? '') === 'quadrado')  ? 'selected' : '' ?>>Quadrado</option>
                <option value="retangulo" <?= (($_POST['figura'] ?? '') === 'retangulo') ? 'selected' : '' ?>>Retângulo</option>
                <option value="circulo"   <?= (($_POST['figura'] ?? '') === 'circulo')   ? 'selected' : '' ?>>Círculo</option>
            </select>
        </label>
        <label id="label1">Lado / Raio (m):
            <input type="number" step="0.01" name="medida1" id="medida1" value="<?= htmlspecialchars($_POST['medida1'] ?? '') ?>" required>
        </label>
        <label id="campo2">Altura (m):
            <input type="number" step="0.01" name="medida2" id="medida2" value="<?= htmlspecialchars($_POST['medida2'] ?? '') ?>">
        </label>
        <button type="submit">Calcular</button>
    </form>

    <script>
    function atualizarCampos() {
        const figura = document.getElementById('figura').value;
        const campo2 = document.getElementById('campo2');
        const label1 = document.getElementById('label1');

        if (figura === 'retangulo') {
            campo2.style.display = 'block';
            label1.firstChild.textContent = 'Base (m): ';
        } else if (figura === 'circulo') {
            campo2.style.display = 'none';
            label1.firstChild.textContent = 'Raio (m): ';
        } else {
            campo2.style.display = 'none';
            label1.firstChild.textContent = 'Lado (m): ';
        }
    }
    window.onload = atualizarCampos;
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $calc = new CalculadoraGeometrica(
            $_POST['figura'],
            (float) $_POST['medida1'],
            (float) ($_POST['medida2'] ?? 0)
        );

        $nomes = [
            'quadrado'  => 'Quadrado',
            'retangulo' => 'Retângulo',
            'circulo'   => 'Círculo',
        ];

        echo "<div class='resultado'>";
        echo "<p>Figura: <strong>" . ($nomes[$calc->getFigura()] ?? '') . "</strong></p>";
        echo "<p class='area'>Área: " . number_format($calc->calcularArea(), 2, ',', '.') . " m²</p>";
        echo "</div>";
    }
    ?>

</body>
</html>