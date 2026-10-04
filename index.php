<?php
require "conexao.php";

try {
    $resultado = $conn->query("SELECT * FROM produtos ORDER BY nome");
} catch (Exception $e) {
    die("Erro ao listar produtos.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
</head>
<body>
    <h1>Gestão de Estoque</h1>
    <a href="form.php">+ Novo produto</a>
    <br><br>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Nome</th><th>Categoria</th><th>Descrição</th>
            <th>Preço</th><th>Quantidade</th><th>Validade</th><th>Ações</th>
        </tr>
        <?php while ($p = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $p["id"] ?></td>
            <td><?= htmlspecialchars($p["nome"]) ?></td>
            <td><?= htmlspecialchars($p["categoria"]) ?></td>
            <td><?= htmlspecialchars($p["descricao"]) ?></td>
            <td>R$ <?= number_format($p["preco"], 2, ",", ".") ?></td>
            <td><?= $p["quantidade"] ?></td>
            <td><?= date("d/m/Y", strtotime($p["validade"])) ?></td>
            <td>
                <a href="form.php?id=<?= $p["id"] ?>">Editar</a>
                <form action="excluir.php" method="post" style="display:inline"
                      onsubmit="return confirm('Excluir este produto?')">
                    <input type="hidden" name="id" value="<?= $p["id"] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>