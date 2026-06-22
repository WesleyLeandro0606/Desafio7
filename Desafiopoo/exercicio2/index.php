<?php require_once 'Aluno.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Média Aluno</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <h2>Informações do Aluno</h2>
     <form method="post">
        <label>Nome:
            <input type="text" name="nome"
                   value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
        </label>
        <label>Disciplina:
            <input type="text" name="disciplina"
                   value="<?= htmlspecialchars($_POST['disciplina'] ?? '') ?>" required>
        </label>
        <label>Nota 1:
            <input type="number" step="0.1" min="0" max="10" name="nota1"
                   value="<?= htmlspecialchars($_POST['nota1'] ?? '') ?>" required>
        </label>
        <label>Nota 2:
            <input type="number" step="0.1" min="0" max="10" name="nota2"
                   value="<?= htmlspecialchars($_POST['nota2'] ?? '') ?>" required>
        </label>
        <label>Nota 3:
            <input type="number" step="0.1" min="0" max="10" name="nota3"
                   value="<?= htmlspecialchars($_POST['nota3'] ?? '') ?>" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $aluno = new Aluno(
            $_POST['nome'],
            $_POST['disciplina'],
            (float)$_POST['nota1'],
            (float)$_POST['nota2'],
            (float)$_POST['nota3']
        );

         $situacao = $aluno->calcularSituacao();

        $classe = match($situacao) {
            'Aprovado'    => 'aprovado',
            'Recuperação' => 'recuperacao',
            default       => 'reprovado',
        };

        echo "<div class='resultado'>";
        echo "<p>" . $aluno->exibirResumo() . "</p>";
        echo "<p>Disciplina: <strong>" . htmlspecialchars($aluno->getDisciplina()) . "</strong></p>";
        echo "<p>Situação: <span class='{$classe}'>{$situacao}</span></p>";
        echo "</div>";
    }
    
    ?>
</body>
</html>