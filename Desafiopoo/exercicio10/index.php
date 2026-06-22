<?php require_once 'ReservaHotel.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>

    <h2>Reserva de Hotel</h2>

    <form method="post">
        <label>Nome do hóspede:
            <input type="text" name="hospede" value="<?= htmlspecialchars($_POST['hospede'] ?? '') ?>" required>
        </label>
        <label>Número de noites:
            <input type="number" min="1" name="noites" value="<?= htmlspecialchars($_POST['noites'] ?? '') ?>" required>
        </label>
        <label>Tipo de quarto:
            <select name="quarto">
                <option value="simples" <?= (($_POST['quarto'] ?? '') === 'simples') ? 'selected' : '' ?>>Simples (R$ 120/noite)</option>
                <option value="luxo"    <?= (($_POST['quarto'] ?? '') === 'luxo')    ? 'selected' : '' ?>>Luxo (R$ 200/noite)</option>
                <option value="suite"   <?= (($_POST['quarto'] ?? '') === 'suite')   ? 'selected' : '' ?>>Suíte (R$ 350/noite)</option>
            </select>
        </label>
        <button type="submit">Reservar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reserva = new ReservaHotel(
            $_POST['hospede'],
            (int) $_POST['noites'],
            $_POST['quarto']
        );

        echo "<div class='resultado'>";
        echo "<p class='boas-vindas'>" . htmlspecialchars($reserva->getMensagemBoasVindas()) . "</p>";
        echo "<p>Total bruto: R$ " . number_format($reserva->calcularTotal(), 2, ',', '.') . "</p>";

        if ($reserva->calcularDesconto() > 0) {
            echo "<p class='desconto'>Desconto (10% acima de 5 noites): - R$ " . number_format($reserva->calcularDesconto(), 2, ',', '.') . "</p>";
        }

        echo "<p class='total'>Total final: R$ " . number_format($reserva->calcularTotalFinal(), 2, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>