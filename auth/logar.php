<?php
include("../database/utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT nome, cargo FROM pessoas WHERE email = ? AND senha = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->bind_result($nome, $cargo);
    $stmt->fetch();

    if ($nome != '') {
        session_start();
        $_SESSION["nome"] = $nome;
        $_SESSION['cargo'] = $cargo;
        header("Location: ../pages/inicio.php");
    } else {
        $resposta = "Usuário ou senha incorreto!";
        header("Location: ../index.php?resposta=$resposta");
        die;
    }
}
