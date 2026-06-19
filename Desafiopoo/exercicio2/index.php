<?php require_once 'Aluno.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Média Aluno</title>
</head>
<body>

    <h2>Informações do Funcionário</h2>
    <form method="post">
        <label>Nome: <input type="text" name="nome" required></label><br><br>
        <label>Disciplina: <input type="text" name="disciplina" required></label><br><br>
        <label>nota1: <input type="number" step="0.0" name="nota1" required></label><br><br>
        <label>nota2: <input type="number" step="0.0" name="nota2" required></label><br><br>
        <label>nota3: <input type="number" step="0.0" name="nota3" required></label><br><br>
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
    }
    ?>
</body>
</html>