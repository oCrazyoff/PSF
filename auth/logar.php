<?php
include("../database/utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT nome, cargo, senha FROM pessoas WHERE email = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($nome, $cargo, $senha_bd);
    $stmt->fetch();

    if ($nome != '' && password_verify($senha, $senha_bd)) {
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
