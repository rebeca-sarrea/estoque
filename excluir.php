<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    try {
        $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
    } catch (Exception $e) {
        die("Erro ao excluir o produto.");
    }
}

header("Location: index.php");
