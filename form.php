<?php
require "conexao.php";

$p = ["id" => "", "nome" => "", "categoria" => "", "descricao" => "",
      "preco" => "", "quantidade" => "", "validade" => ""];

if (isset($_GET["id"])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $achou = $stmt->get_result()->fetch_assoc();
    } catch (Exception $e) {
        die("Erro ao buscar produto.");
    }
    if (!$achou) {
        die("Produto não encontrado.");
    }
    $p = $achou;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
</head>
<body>
    <h1><?= $p["id"] ? "Editar" : "Novo" ?> produto</h1>
    <form action="salvar.php" method="post">
        <input type="hidden" name="id" value="<?= $p["id"] ?>">

        <br>
        <input type="text" name="nome" value="<?= htmlspecialchars($p["nome"]) ?>"><br><br>

        <br>
        <input type="text" name="categoria" value="<?= htmlspecialchars($p["categoria"]) ?>"><br><br>

        <br>
        <textarea name="descricao"><?= htmlspecialchars($p["descricao"]) ?></textarea><br><br>

        <br>
        <input type="text" name="preco" value="<?= htmlspecialchars($p["preco"]) ?>"><br><br>

        <br>
        <input type="text" name="quantidade" value="<?= htmlspecialchars($p["quantidade"]) ?>"><br><br>

        <br>
        <input type="date" name="validade" value="<?= htmlspecialchars($p["validade"]) ?>"><br><br>

        <button type="submit">Salvar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
