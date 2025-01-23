<?php
include("../database/utils/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars($_POST["senha"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $resposta = "Usuário ou senha incorreto!";
        header("Location: ../index.php?resposta=$resposta");
        exit;
    }

    if (isset($_POST["email"]) and isset($_POST["senha"])) {
        $sql = "SELECT nome, id, cargo, email, senha FROM pessoas WHERE email = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($nome, $id, $cargo, $email, $senha_bd);
            $stmt->fetch();

            if ($nome != '' && password_verify($senha, $senha_bd)) {
                session_start();
                $_SESSION["id"] = $id;
                $_SESSION["nome"] = $nome;
                $_SESSION["email"] = $email;
                $_SESSION['cargo'] = $cargo;
                header("Location: ../pages/inicio.php");
                exit;
            } else {
                $resposta = "Usuário ou senha incorreto!";
                header("Location: ../index.php?resposta=$resposta");
                exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

$conn->close();

header("Location: ../index.php?resposta=$resposta");
exit;
