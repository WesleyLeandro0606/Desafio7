<?php require_once 'Produto.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>

    <h2>Controle de Estoque</h2>

    <form method="post">
        <label>Nome do produto:
            <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
        </label>
        <label>Quantidade inicial em estoque:
            <input type="number" name="quantidade" min="0" value="<?= htmlspecialchars($_POST['quantidade'] ?? '') ?>" required>
        </label>
        <label>Valor unitário (R$):
            <input type="number" step="0.01" name="valor" value="<?= htmlspecialchars($_POST['valor'] ?? '') ?>" required>
        </label>
        <label>Operação:
            <select name="operacao">
                <option value="entrada" <?= (($_POST['operacao'] ?? '') === 'entrada') ? 'selected' : '' ?>>Entrada</option>
                <option value="saida"   <?= (($_POST['operacao'] ?? '') === 'saida')   ? 'selected' : '' ?>>Saída</option>
                <option value="consulta"<?= (($_POST['operacao'] ?? '') === 'consulta')? 'selected' : '' ?>>Consultar</option>
            </select>
        </label>
        <label>Quantidade da movimentação:
            <input type="number" name="mov" min="0" value="<?= htmlspecialchars($_POST['mov'] ?? '') ?>">
        </label>
        <button type="submit">Executar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $produto = new Produto(
            $_POST['nome'],
            (int)   $_POST['quantidade'],
            (float) $_POST['valor']
        );

        $mensagem = '';
        $classe   = 'ok';
        $mov      = (int) ($_POST['mov'] ?? 0);

        switch ($_POST['operacao']) {
            case 'entrada':
                $produto->entrada($mov);
                $mensagem = "Entrada de {$mov} unidade(s) realizada.";
                break;
            case 'saida':
                $resultado = $produto->saida($mov);
                $mensagem  = $resultado;
                if (str_contains($resultado, 'insuficiente')) $classe = 'erro';
                break;
            case 'consulta':
                $mensagem = "Consulta realizada.";
                break;
        }

        echo "<div class='resultado'>";
        echo "<p>Produto: <strong>" . htmlspecialchars($produto->getNome()) . "</strong></p>";
        echo "<p>Estoque atual: <strong>" . $produto->getQuantidade() . " unidades</strong></p>";
        echo "<p>Valor unitário: R$ " . number_format($produto->getValorUnitario(), 2, ',', '.') . "</p>";
        echo "<p>Valor total em estoque: <strong>R$ " . number_format($produto->getValorTotalEstoque(), 2, ',', '.') . "</strong></p>";
        echo "<p class='{$classe}'>{$mensagem}</p>";
        echo "</div>";
    }
    ?>

</body>
</html>