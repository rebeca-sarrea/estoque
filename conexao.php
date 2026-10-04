<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli("localhost", "root", "", "estoque");
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Erro ao conectar no banco de dados.");
}