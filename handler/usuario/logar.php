<?php
include("../utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT nome FROM pessoas WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss",$cpf,$senha);
    $stmt->execute();
    $stmt->bind_result($nome);
    $stmt->fetch();

    if($nome != ''){
        session_start();
        $_SESSION["nome"] = $nome;
        header("Location: ../pages/inicio.php");
    } else {
        header("Location: ../index.php?erro=1");
        die;
    }
}
