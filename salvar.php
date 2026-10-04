<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id         = $_POST["id"] ?? "";
$nome       = trim($_POST["nome"] ?? "");
$categoria  = trim($_POST["categoria"] ?? "");
$descricao  = trim($_POST["descricao"] ?? "");
$preco      = str_replace(",", ".", trim($_POST["preco"] ?? ""));
$quantidade = trim($_POST["quantidade"] ?? "");
$validade   = $_POST["validade"] ?? "";

$erros = [];

if ($nome === "" || strlen($nome) > 100) {
    $erros[] = "Nome é obrigatório (máx. 100 caracteres).";
}
if ($categoria === "" || strlen($categoria) > 50) {
    $erros[] = "Categoria é obrigatória (máx. 50 caracteres).";
}
if (!is_numeric($preco) || $preco < 0) {
    $erros[] = "Preço deve ser um número maior ou igual a zero.";
}
if (!ctype_digit($quantidade)) {
    $erros[] = "Quantidade deve ser um número inteiro maior ou igual a zero.";
}
$data = DateTime::createFromFormat("Y-m-d", $validade);
if (!$data || $data->format("Y-m-d") !== $validade) {
    $erros[] = "Data de validade inválida.";
}

if ($erros) {
    echo "<h2>Erros:</h2>";
    foreach ($erros as $e) {
        echo "<p>" . htmlspecialchars($e) . "</p>";
    }
    echo "<a href='javascript:history.back()'>Voltar</a>";
    exit;
}

try {
    if ($id === "") {
        $stmt = $conn->prepare(
            "INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, validade)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssdis", $nome, $categoria, $descricao, $preco, $quantidade, $validade);
    } else {
        $stmt = $conn->prepare(
            "UPDATE produtos SET nome = ?, categoria = ?, descricao = ?,
             preco = ?, quantidade = ?, validade = ? WHERE id = ?"
        );
        $stmt->bind_param("sssdisi", $nome, $categoria, $descricao, $preco, $quantidade, $validade, $id);
    }
    $stmt->execute();
} catch (Exception $e) {
    die("Erro ao salvar o produto.");
}

header("Location: index.php");