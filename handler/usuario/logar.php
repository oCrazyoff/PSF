<?php
include("../utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM pessoas WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    if ($stmt->bind_param("ss", $email, $senha)) {

        if ($stmt->execute()) {
            header("Location: ../../pages/inicio.php");
        } else {
            die("Erro");
        }
    } else {
        die("Erro");
    }
} else {
    die("Erro");
}
